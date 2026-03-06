<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
        ['email' => 'admin@example.com'],
        [
            'name' => 'System Admin',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]
        );

        // Create a few student accounts for testing
        User::updateOrCreate(
        ['email' => 'student1@example.com'],
        [
            'name' => 'Student One',
            'password' => Hash::make('password123'),
            'role' => 'student',
        ]
        );
    }
}
