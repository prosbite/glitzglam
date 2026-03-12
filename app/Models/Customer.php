<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'contact_number',
        'address',
        'social_media_link',
        'is_blacklisted',
        'admin_notes',
    ];

    protected $casts = [
        'detail_info' => 'array',
        'is_blacklisted' => 'boolean',
    ];

    // This creates a virtual "full_name" property
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => "{$this->first_name} {$this->last_name}",
        );
    }

    // Relationship: One Customer can have many Rentals
    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    // Scope for that "Real-time Search"
    public function scopeSearch($query, $term)
    {
        return $query->where('first_name', 'LIKE', "%{$term}%")
            ->orWhere('last_name', 'LIKE', "%{$term}%")
            ->orWhere('contact_number', 'LIKE', "%{$term}%");
    }
}
