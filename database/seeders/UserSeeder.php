<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@churchfinder.com'],
            [
                'name' => 'Admin Utama',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'phone' => '081234567890',
                'is_active' => true,
            ]
        );

        User::firstOrCreate(
            ['email' => 'johndoe@example.com'],
            [
                'name' => 'John Doe',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '089876543210',
                'is_active' => true,
            ]
        );
        
        if (isset($this->command)) {
            $this->command->info("Users Seeded Successfully!");
        }
    }
}
