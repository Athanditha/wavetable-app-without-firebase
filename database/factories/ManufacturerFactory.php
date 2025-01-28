<?php

namespace Database\Factories;

use App\Models\Manufacturer;
use Illuminate\Database\Eloquent\Factories\Factory;

class ManufacturerFactory extends Factory
{
    protected $model = Manufacturer::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'contact_name' => $this->faker->name,
            'contact_phone' => $this->faker->phoneNumber,
        ];
    }
}
