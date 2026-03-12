<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    /** @use HasFactory<\Database\Factories\RentalFactory> */
    use HasFactory;

    // Inside Rental.php
    public function items()
    {
        return $this->hasMany(RentalItem::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // Accessor to see the total "locked-in" price for the whole booking
    public function getTotalAmountAttribute()
    {
        return $this->items->sum('rental_fee');
    }
}
