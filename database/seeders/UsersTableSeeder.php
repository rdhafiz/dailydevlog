<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Create an admin user
        User::create([
            'username' => 'dailydevlog',
            'name' => 'Test User',
            'email' => 'dailydevlog@mailinator.com',
            'password' => '12345678', // This will be hashed automatically
            // Add other user fields if needed
        ]);
    }
}
