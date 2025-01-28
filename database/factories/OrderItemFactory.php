<?php

namespace Database\Factories;

use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(), // Automatically create an Order if none exists
            'item_id' => Item::factory(),  // Automatically create an Item if none exists
            'quantity' => $this->faker->numberBetween(1, 5),
            'price' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}
