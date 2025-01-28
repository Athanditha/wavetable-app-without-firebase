<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

class ItemFactory extends Factory
{
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'brand' => $this->faker->company,
            'name' => $this->faker->word,
            'category' => $this->faker->word,
            'description' => $this->faker->sentence,
            'sale_price' => $this->faker->randomFloat(2, 10, 1000),
            'rental_rate' => $this->faker->randomFloat(2, 1, 100),
            'quantity' => $this->faker->numberBetween(1, 100),
            'image' => 'itemimages/' . $this->faker->word . '.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
