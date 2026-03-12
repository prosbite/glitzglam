<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = ['item_code', 'category_id', 'custom_rental_fee', 'custom_security_deposit', 'specifics', 'description', 'is_active', 'status'];

    protected $casts = [
        'specifics' => 'array', // Automatically turns JSON into a PHP array
    ];

    // This helper calculates the price so you don't have to do it in Vue
    public function getFinalRentalFeeAttribute()
    {
        return $this->custom_rental_fee ?? $this->category->default_rental_fee;
    }

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    // Get just the main thumbnail
    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', true);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
