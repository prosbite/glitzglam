<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;

    protected $fillable = ['type', 'name', 'slug'];

    // Usage: Tag::type('color')->get();
    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($tag) {
            $tag->slug = \Illuminate\Support\Str::slug($tag->name);
        });
    }

    // Relationships
    public function products() { return $this->belongsToMany(Product::class); }
}
