<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'movie_id',
        'author',
        'rating',
        'content',
    ];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
