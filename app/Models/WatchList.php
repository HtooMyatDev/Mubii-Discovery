<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WatchList extends Model
{
    protected $table = [
        'user_id',
        'movie_id',
    ];
}
