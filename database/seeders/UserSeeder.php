<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // UserSeeder.php
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com', // or 'admin' if you use a username field
            'password' => Hash::make('admin-user'),
            'email_verified_at' => now(),
        ]);
    }
}
