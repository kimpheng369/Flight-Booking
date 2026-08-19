<?php

namespace Database\Factories;

use App\Models\Aircraft;
use App\Models\Airline;
use App\Models\Airport;
use App\Models\Flight;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlightFactory extends Factory
{
    protected $model = Flight::class;

    public function definition(): array
    {
        $depDate = fake()->dateTimeBetween('now', '+30 days');
        $totalSeats = fake()->randomElement([150, 180, 200]);

        return [
            'airline_id' => Airline::factory(),
            'aircraft_id' => Aircraft::factory(),
            'origin_airport_id' => Airport::factory(),
            'destination_airport_id' => Airport::factory(),
            'flight_number' => strtoupper(fake()->unique()->bothify('SK-###')),
            'departure_date' => $depDate->format('Y-m-d'),
            'departure_time' => fake()->time('H:i:00'),
            'arrival_date' => $depDate->format('Y-m-d'),
            'arrival_time' => fake()->time('H:i:00'),
            'price' => fake()->randomFloat(2, 45, 850),
            'total_seats' => $totalSeats,
            'available_seats' => $totalSeats,
            'baggage_allowance' => '23kg',
            'status' => 'Scheduled',
        ];
    }
}
