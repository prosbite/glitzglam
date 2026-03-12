<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalRequest extends Model
{
    /** @use HasFactory<\Database\Factories\RentalRequestFactory> */
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'contact_number',
        'fb_profile_link',
        'item_code_requested',
        'requested_pickup_date',
        'images',
        'notes',
        'status',
    ];
}
