<?php

namespace Database\Factories;

use App\Models\Airline;
use Illuminate\Database\Eloquent\Factories\Factory;

class AirlineFactory extends Factory
{
    protected $model = Airline::class;

    public function definition(): array
    {
        return [
            'name' => fake()->company() . ' Air',
            'code' => strtoupper(fake()->bothify('??')),
            'logo' => null,
            'country' => fake()->country(),
        ];
    }
}
