<?php

namespace Database\Factories;

use App\Models\Airport;
use Illuminate\Database\Eloquent\Factories\Factory;

class AirportFactory extends Factory
{
    protected $model = Airport::class;

    public function definition(): array
    {
        return [
            'name' => fake()->city() . ' International Airport',
            'code' => strtoupper(fake()->unique()->lexify('???')),
            'city' => fake()->city(),
            'country' => fake()->country(),
            'timezone' => 'Asia/Phnom_Penh',
        ];
    }
}
