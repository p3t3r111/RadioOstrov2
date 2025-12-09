<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Vote extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'datum',
        'users_id',
        'songId',
        'username',
        'songName',
        'songAuthor',
        'songImgPath'
    ];
}
