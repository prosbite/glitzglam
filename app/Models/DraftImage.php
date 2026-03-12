<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DraftImage extends Model
{
    /** @use HasFactory<\Database\Factories\DraftImageFactory> */
    use HasFactory;

    protected $fillable = ['draft_rental_id', 'image_path'];

    public function draftRental()
    {
        return $this->belongsTo(DraftRental::class);
    }
}
