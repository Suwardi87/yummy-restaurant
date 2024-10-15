<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'owner',
            'email' => 'owner@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password123'),
            'role' => 'owner'
        ]);

        User::create([
            'name' => 'operator',
            'email' => 'operator@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt(value: 'password123'),
            'role' => 'operator'
        ]);
    }
}

