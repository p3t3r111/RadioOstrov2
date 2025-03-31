<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class active_voting_song extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'songId',
        'imgPath',
        'author',
        'title',
    ];
}
