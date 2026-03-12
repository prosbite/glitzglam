<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // CategorySeeder.php
        $categories = [
            ['name' => 'Gown', 'prefix' => 'GW', 'default_rental_fee' => 2000, 'default_security_deposit' => 1000],
            ['name' => 'Suit', 'prefix' => 'ST', 'default_rental_fee' => 1500, 'default_security_deposit' => 800],
            ['name' => 'Barong', 'prefix' => 'BR', 'default_rental_fee' => 1800, 'default_security_deposit' => 900],
            ['name' => 'Accessories', 'prefix' => 'AC', 'default_rental_fee' => 500, 'default_security_deposit' => 300],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }
    }
}
