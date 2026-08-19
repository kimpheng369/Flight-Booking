<?php

namespace Tests\Feature;

use App\Models\Flight;
use App\Models\User;
use App\Services\BookingService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingOverbookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_booking_fails_when_requesting_more_seats_than_available(): void
    {
        $user = User::factory()->create();
        $flight = Flight::factory()->create([
            'total_seats' => 10,
            'available_seats' => 2,
            'price' => 100,
            'status' => 'Scheduled',
        ]);

        $this->actingAs($user);

        $response = $this->post(route('flights.book.store', $flight), [
            'flight_id' => $flight->id,
            'seats' => 3, // requesting 3 when only 2 exist
            'first_name' => 'John',
            'last_name' => 'Doe',
            'gender' => 'Male',
            'date_of_birth' => '1995-01-01',
            'passport_number' => 'N1234567',
            'phone' => '+85512345678',
            'email' => 'john@example.com',
        ]);

        $response->assertSessionHas('error');
        $this->assertEquals(2, $flight->fresh()->available_seats);
    }

    public function test_booking_succeeds_and_deducts_seats_atomically(): void
    {
        $user = User::factory()->create();
        $flight = Flight::factory()->create([
            'total_seats' => 10,
            'available_seats' => 2,
            'price' => 100,
            'status' => 'Scheduled',
        ]);

        $this->actingAs($user);

        $response = $this->post(route('flights.book.store', $flight), [
            'flight_id' => $flight->id,
            'seats' => 2,
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'gender' => 'Female',
            'date_of_birth' => '1996-05-10',
            'passport_number' => 'N7654321',
            'phone' => '+85512345678',
            'email' => 'jane@example.com',
        ]);

        $response->assertRedirect();
        $this->assertEquals(0, $flight->fresh()->available_seats);
        $this->assertDatabaseHas('bookings', [
            'user_id' => $user->id,
            'seats' => 2,
            'booking_status' => 'Confirmed',
        ]);
    }

    public function test_cancelling_booking_restores_available_seats(): void
    {
        $user = User::factory()->create();
        $flight = Flight::factory()->create([
            'total_seats' => 100,
            'available_seats' => 90,
            'status' => 'Scheduled',
        ]);

        $bookingService = app(BookingService::class);

        $passengerData = [
            'first_name' => 'David',
            'last_name' => 'Miller',
            'gender' => 'Male',
            'date_of_birth' => '1990-03-12',
            'passport_number' => 'N8888888',
            'phone' => '+14155550199',
            'email' => 'david@test.com',
        ];

        $booking = $bookingService->createBooking($user, $flight, $passengerData, 4);

        $this->assertEquals(86, $flight->fresh()->available_seats);

        $bookingService->cancelBooking($booking);

        $this->assertEquals(90, $flight->fresh()->available_seats);
        $this->assertEquals('Cancelled', $booking->fresh()->booking_status);
    }
}
