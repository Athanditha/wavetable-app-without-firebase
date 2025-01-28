<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'usertype' => 'admin', // Admin role
            'email_verified_at' => now(),
        ]);

        // Create a regular user
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'usertype' => 'user', // Regular user role
            'email_verified_at' => now(),
        ]);

        // Create another user
        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => Hash::make('password123'),
            'usertype' => 'user', // Regular user role
            'email_verified_at' => now(),
        ]);
    }
}
