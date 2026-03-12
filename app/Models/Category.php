<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    protected $fillable = [
    'name',
    'prefix',
    'default_rental_fee',
    'default_security_deposit'
];

// Relationship: One Category has many Products
public function products()
{
    return $this->hasMany(Product::class);
}
}
