<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::insert([
            [
                'brand' => 'Sony',
                'name' => 'Wireless Headphones',
                'category' => 'Electronics',
                'description' => 'Noise-cancelling over-ear headphones.',
                'sale_price' => 199.99,
                'rental_rate' => 9.99,
                'quantity' => 50,
                'image' => 'itemimages/sony-headphones.jpg', // Path to image
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand' => 'Apple',
                'name' => 'iPhone 14',
                'category' => 'Electronics',
                'description' => 'Latest model smartphone with advanced features.',
                'sale_price' => 999.99,
                'rental_rate' => 49.99,
                'quantity' => 30,
                'image' => 'itemimages/iphone-14.jpg', // Path to image
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand' => 'Yamaha',
                'name' => 'Acoustic Guitar',
                'category' => 'Musical Instruments',
                'description' => '6-string acoustic guitar with a rich sound.',
                'sale_price' => 299.99,
                'rental_rate' => 19.99,
                'quantity' => 15,
                'image' => 'itemimages/yamaha-guitar.jpg', // Path to image
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'brand' => 'Canon',
                'name' => 'DSLR Camera',
                'category' => 'Photography',
                'description' => '24.1 MP camera with multiple lens options.',
                'sale_price' => 599.99,
                'rental_rate' => 29.99,
                'quantity' => 20,
                'image' => 'itemimages/canon-camera.jpg', // Path to image
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
