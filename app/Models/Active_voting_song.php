<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Active_voting_song extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'song_id',
    ];

    public function song()
    {
        return $this->belongsTo(Song::class);
    }

    public static function count()
    {
        return self::all()->count();
    }
}
