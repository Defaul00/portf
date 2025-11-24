<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@airbook.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081234567890',
            'email_verified_at' => now(),
        ]);

        // Create sample regular user
        User::create([
            'name' => 'John Doe',
            'email' => 'user@airbook.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'phone' => '081234567891',
            'email_verified_at' => now(),
        ]);
    }
}
