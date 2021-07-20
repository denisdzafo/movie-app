<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'refrence_code', 'category_id', 'image', 'year'
    ];

    public function categories()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
}
