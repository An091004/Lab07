<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class TestUserSeeder extends Seeder
{
    public function run(): void
    {
        // User 1 - Author of articles 1 and 3
        User::create([
            'id' => 1,
            'name' => 'Author One',
            'email' => 'author1@example.com',
            'password' => Hash::make('password123'),
        ]);

        // User 2 - Author of article 2
        User::create([
            'id' => 2,
            'name' => 'Author Two',
            'email' => 'author2@example.com',
            'password' => Hash::make('password123'),
        ]);

        // User 3 - Regular user (not an author of any article)
        User::create([
            'id' => 3,
            'name' => 'Regular User',
            'email' => 'user3@example.com',
            'password' => Hash::make('password123'),
        ]);
    }
}