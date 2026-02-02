<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@kthiuuhotel.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Create demo user
        User::create([
            'name' => 'Demo User',
            'email' => 'user@kthiuuhotel.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
        ]);
    }
}
