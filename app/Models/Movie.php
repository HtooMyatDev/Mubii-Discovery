<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'plot',
        'poster',
        'runtime',
        'director_id',
        'writer',
        'cast_id',
        'genre_id',
        'trailer_id',
        'total_seasons',
        'type',
        'languages',
        'country_of_origin',
        'released_date',
    ];
}
