<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RentalSeeder extends Seeder
{
    public function run(): void
    {
        $maria = Customer::where('first_name', 'Maria')->first();
        $gown = Product::where('item_code', 'GW-01')->first();
        $suit = Product::where('item_code', 'ST-01')->first();

        // SCENARIO 1: The "Active" Rental (Picked Up yesterday)
        $activeRental = Rental::create([
            'customer_id' => $maria->id,
            'status' => 'picked_up',
            'pickup_date' => Carbon::yesterday(),
            'return_date' => Carbon::tomorrow(), // 3-day rule
        ]);

        $activeRental->items()->create([
            'product_id' => $gown->id,
            'rental_fee' => 2500.00,
            'security_deposit' => 1000.00,
            'status' => 'picked_up',
        ]);

        // Update physical gown status
        $gown->update(['status' => 'rented']);

        // Record the Downpayment
        Payment::create([
            'rental_id' => $activeRental->id,
            'amount' => 1500.00,
            'type' => 'downpayment',
            'method' => 'gcash',
            'reference_number' => 'GC-123456789',
        ]);

        // SCENARIO 2: The "Overdue" Rental (Picked up 5 days ago)
        $overdueRental = Rental::create([
            'customer_id' => $maria->id, // Re-using Maria for testing
            'status' => 'picked_up',
            'pickup_date' => Carbon::now()->subDays(5),
            'return_date' => Carbon::now()->subDays(2),
        ]);

        $overdueRental->items()->create([
            'product_id' => $suit->id,
            'rental_fee' => 1800.00,
            'security_deposit' => 500.00,
            'status' => 'picked_up',
        ]);

        $suit->update(['status' => 'rented']);
    }
}
