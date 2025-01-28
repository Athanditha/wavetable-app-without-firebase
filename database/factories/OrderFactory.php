<?php


namespace Database\Factories;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'customer_id' => Customer::factory(), // Creates a customer automatically
            'status' => $this->faker->randomElement(['Pending', 'Completed', 'Cancelled']),
            'total' => $this->faker->randomFloat(2, 50, 1000), // Total price between 50 and 1000
        ];
    }
}

