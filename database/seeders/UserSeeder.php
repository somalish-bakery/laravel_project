<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    // Create Demo Customer
    \App\Models\User::create([
        'name' => 'Demo User',
        'phone' => '012345678',
        'password' => bcrypt('demo123'),
        'role' => 'customer',
    ]);

    // Create Admin (For Image 12)
    \App\Models\User::create([
        'name' => 'Admin Staff',
        'phone' => 'admin',
        'password' => bcrypt('admin123'),
        'role' => 'admin',
    ]);
}
}
