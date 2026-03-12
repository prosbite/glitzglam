<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            TagSeeder::class,
            CustomerSeeder::class,
            // We'll call ProductSeeder after these are done
        ]);

        // Now seed products
        $this->call(ProductSeeder::class);
        // Now seed rentals
        $this->call(RentalSeeder::class);
    }
}
