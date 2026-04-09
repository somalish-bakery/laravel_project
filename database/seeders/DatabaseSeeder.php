<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
{
    // Create the Demo Customer
    \App\Models\User::create([
        'name' => 'Demo Customer',
        'phone' => '012345678',
        'password' => \Illuminate\Support\Facades\Hash::make('demo123'),
        'role' => 'customer',
    ]);

    // Create the Admin Account
    \App\Models\User::create([
        'name' => 'Admin Staff',
        'phone' => 'admin',
        'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
        'role' => 'admin',
    ]);

    // Add some Food items so the home page works
    \App\Models\Food::create([
        'name' => 'Fish Amok',
        'khmer_name' => 'អាម៉ុកត្រី',
        'description' => 'Traditional Khmer steamed curry fish.',
        'price' => 5.50,
        'category' => 'Main',
        'is_popular' => true,
    ]);
}
}
