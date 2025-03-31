<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_songs');
    }

    protected $table = 'songs';

    protected $fillable = [
        'title',
        'songId',
        'author',
        'img_path',
    ];
}
