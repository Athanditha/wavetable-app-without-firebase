<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Item;
use Illuminate\Database\Seeder;
use App\Models\Manufacturer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\EquipmentCategory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create items, customers, and users
        $this->call([
            ItemsTableSeeder::class,
            UserSeeder::class,
        ]);

        // Create 10 Manufacturers
        Manufacturer::factory(10)->create();

        // Create 10 Orders with related OrderItems
        Order::factory(10)->has(OrderItem::factory()->count(3))->create();

        // Create 5 Equipment Categories
        EquipmentCategory::factory(5)->create();
    }
}
