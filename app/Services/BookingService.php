<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Flight;
use App\Models\Passenger;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Exception;

class BookingService
{
    /**
     * Check if a flight has enough available seats.
     */
    public function checkAvailability(Flight $flight, int $seats = 1): bool
    {
        return $flight->available_seats >= $seats && $flight->status !== 'Cancelled';
    }

    /**
     * Calculate total price for given flight and seat count.
     */
    public function calculateTotal(Flight $flight, int $seats = 1): float
    {
        return (float) ($flight->price * $seats);
    }

    /**
     * Generate a unique booking reference like SKY-8F29KD.
     */
    public function generateBookingReference(): string
    {
        do {
            $reference = 'SKY-' . strtoupper(Str::random(6));
        } while (Booking::where('booking_reference', $reference)->exists());

        return $reference;
    }

    /**
     * Create a booking with database transaction & overbooking protection.
     *
     * @throws Exception
     */
    public function createBooking(User $user, Flight $flight, array $passengerData, int $seats = 1): Booking
    {
        if ($seats <= 0) {
            throw new InvalidArgumentException('Seat count must be at least 1.');
        }

        return DB::transaction(function () use ($user, $flight, $passengerData, $seats) {
            // Lock flight record for update to prevent concurrent booking race conditions
            $lockedFlight = Flight::where('id', $flight->id)->lockForUpdate()->first();

            if (!$lockedFlight || $lockedFlight->available_seats < $seats || $lockedFlight->status === 'Cancelled') {
                throw new Exception('Not enough available seats for this flight.');
            }

            // Create or update passenger record
            $passenger = Passenger::create([
                'user_id' => $user->id,
                'first_name' => $passengerData['first_name'],
                'last_name' => $passengerData['last_name'],
                'gender' => $passengerData['gender'] ?? 'Male',
                'date_of_birth' => $passengerData['date_of_birth'] ?? null,
                'passport_number' => $passengerData['passport_number'] ?? null,
                'phone' => $passengerData['phone'] ?? $user->phone,
                'email' => $passengerData['email'] ?? $user->email,
            ]);

            // Deduct available seats atomically
            $lockedFlight->decrement('available_seats', $seats);

            // Calculate price
            $totalPrice = $this->calculateTotal($lockedFlight, $seats);
            $reference = $this->generateBookingReference();

            // Create booking
            return Booking::create([
                'user_id' => $user->id,
                'flight_id' => $lockedFlight->id,
                'passenger_id' => $passenger->id,
                'booking_reference' => $reference,
                'seats' => $seats,
                'total_price' => $totalPrice,
                'booking_status' => 'Confirmed',
                'payment_status' => 'Paid',
                'booked_at' => now(),
            ]);
        });
    }

    /**
     * Cancel a booking and restore seats to the flight using DB transaction.
     *
     * @throws Exception
     */
    public function cancelBooking(Booking $booking): bool
    {
        return DB::transaction(function () use ($booking) {
            if ($booking->booking_status === 'Cancelled') {
                return true;
            }

            $flight = Flight::where('id', $booking->flight_id)->lockForUpdate()->first();

            if ($flight) {
                // Restore seats but ensure available_seats does not exceed total_seats
                $newAvailable = min($flight->total_seats, $flight->available_seats + $booking->seats);
                $flight->update(['available_seats' => $newAvailable]);
            }

            $booking->update([
                'booking_status' => 'Cancelled',
                'payment_status' => 'Refunded',
            ]);

            return true;
        });
    }
}
