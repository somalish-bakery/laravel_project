<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    // Force Laravel to use the 'food' table
    protected $table = 'food';

    protected $fillable = [
        'name', 
        'khmer_name', 
        'description', 
        'price', 
        'category', 
        'image', 
        'is_popular'
    ];

    public function getFormattedPriceAttribute()
    {
        return '$' . number_format($this->price, 2);
    }
}