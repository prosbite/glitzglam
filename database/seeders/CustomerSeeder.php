<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // CustomerSeeder.php
        Customer::create([
            'first_name' => 'Maria',
            'last_name' => 'Santos',
            'contact_number' => '09171234567',
            'social_media_link' => 'https://facebook.com/mariasantos.sample',
            'detail_info' => ['waist' => '28in', 'bust' => '34in'],
        ]);

        Customer::create([
            'first_name' => 'Juan',
            'last_name' => 'Dela Cruz',
            'contact_number' => '09189876543',
            'is_blacklisted' => true,
            'admin_notes' => 'Did not return accessories in 2025.',
        ]);
    }
}
