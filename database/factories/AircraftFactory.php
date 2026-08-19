<?php

namespace Database\Factories;

use App\Models\Aircraft;
use App\Models\Airline;
use Illuminate\Database\Eloquent\Factories\Factory;

class AircraftFactory extends Factory
{
    protected $model = Aircraft::class;

    public function definition(): array
    {
        return [
            'airline_id' => Airline::factory(),
            'model' => fake()->randomElement(['Airbus A320-200', 'Airbus A350-900', 'Boeing 737-800', 'Boeing 787-9 Dreamliner', 'ATR 72-600']),
            'registration_number' => strtoupper(fake()->unique()->bothify('XU-???')),
            'seat_capacity' => fake()->randomElement([150, 180, 220, 300]),
        ];
    }
}
