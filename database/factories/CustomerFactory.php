<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CustomerFactory extends Factory
{
    protected $model = \App\Models\Customer::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_name' => $this->faker->unique()->userName,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), // Default password
            'contact_no' => $this->faker->phoneNumber,
        ];
    }
}
