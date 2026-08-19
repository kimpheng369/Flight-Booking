<?php

namespace Database\Factories;

use App\Models\Passenger;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PassengerFactory extends Factory
{
    protected $model = Passenger::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'gender' => fake()->randomElement(['Male', 'Female']),
            'date_of_birth' => fake()->date('Y-m-d', '-18 years'),
            'passport_number' => strtoupper(fake()->bothify('N#######')),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->safeEmail(),
        ];
    }
}
