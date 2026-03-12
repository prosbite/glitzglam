<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentalItem extends Model
{
    protected $fillable = [
        'rental_id',
        'product_id',
        'rental_fee',
        'security_deposit',
        'status',
    ];

    // Relationships
    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Logic: Is this specific item still out?
    public function getIsOutAttribute()
    {
        return $this->status === 'picked_up';
    }

    protected static function booted()
    {
        // When an item is marked "picked_up", update the Product to "rented"
        static::updated(function ($rentalItem) {
            if ($rentalItem->status === 'picked_up') {
                $rentalItem->product->update(['status' => 'rented']);
            }

            // When it comes back, make it "available" again
            if ($rentalItem->status === 'returned') {
                $rentalItem->product->update(['status' => 'available']);
            }
        });
    }
}
