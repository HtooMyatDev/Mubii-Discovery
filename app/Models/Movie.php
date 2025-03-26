<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'poster',
        'director_id',
        'cast_id',
        'genre_id',
        'trailer_id',
        'languages',
        'country_of_origin',
        'released_date',
    ];
}
