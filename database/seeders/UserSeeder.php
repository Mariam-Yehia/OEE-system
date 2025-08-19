<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'Admin User', 'email' => 'admin@example.com', 'password' => Hash::make('password123')],
            ['name' => 'Operator User', 'email' => 'operator@example.com', 'password' => Hash::make('password123')],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}