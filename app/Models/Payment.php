<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentFactory> */
    use HasFactory;

    protected $fillable = ['rental_id', 'amount', 'type', 'method', 'reference_number', 'notes'];

    // Relationship
    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }

    // Scopes for easy reporting
    public function scopeRevenue($query)
    {
        return $query->whereIn('type', ['downpayment', 'balance', 'penalty']);
    }

    public function scopeDeposits($query)
    {
        return $query->where('type', 'security_deposit');
    }
}
