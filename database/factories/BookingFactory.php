<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Flight;
use App\Models\Passenger;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition(): array
    {
        $seats = fake()->numberBetween(1, 3);
        $pricePerSeat = fake()->randomFloat(2, 50, 500);

        return [
            'user_id' => User::factory(),
            'flight_id' => Flight::factory(),
            'passenger_id' => Passenger::factory(),
            'booking_reference' => 'SKY-' . strtoupper(fake()->unique()->bothify('??????')),
            'seats' => $seats,
            'total_price' => $seats * $pricePerSeat,
            'booking_status' => fake()->randomElement(['Confirmed', 'Pending', 'Cancelled']),
            'payment_status' => fake()->randomElement(['Paid', 'Unpaid']),
            'booked_at' => fake()->dateTimeBetween('-3 months', 'now'),
        ];
    }
}
