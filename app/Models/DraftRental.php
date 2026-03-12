<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DraftRental extends Model
{
    /** @use HasFactory<\Database\Factories\DraftRentalFactory> */
    use HasFactory;

    protected $fillable = ['data', 'status'];

    protected $casts = [
        'data' => 'array',
    ];

    // Helper to see if it's ready for conversion
    public function isReady()
    {
        return isset($this->data['first_name']) && isset($this->data['last_name']);
    }

    public function images()
    {
        return $this->hasMany(DraftImage::class);
    }
}
