<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Services\FirebaseService;

class FirebaseSeeder extends Seeder
{
    protected $firebaseService;

    public function __construct(FirebaseService $firebaseService)
    {
        $this->firebaseService = $firebaseService;
    }

    public function run()
    {
        // Example data to seed to Firebase
        $items = [
            [
                'brand' => 'Yamaha',
                'name' => 'Acoustic Guitar',
                'category' => 'Guitar',
                'description' => 'A great acoustic guitar.',
                'quantity' => 15,
                'sale_price' => 200.00,
                'rental_rate' => 50.00,
            ],
            [
                'brand' => 'Roland',
                'name' => 'Digital Piano',
                'category' => 'Piano',
                'description' => 'A digital piano with great sound.',
                'quantity' => 5,
                'sale_price' => 1200.00,
                'rental_rate' => 300.00,
            ],
        ];

        // Loop through the items and insert them into Firebase
        foreach ($items as $item) {
            $this->firebaseService->seedData($item);
        }

        echo "Data seeded successfully!";
    }
}
