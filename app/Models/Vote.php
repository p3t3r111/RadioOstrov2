<?php

namespace App\Models;

use App\Actions\CheckHolidays;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Vote extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'datum',
        'user_id',
        'song_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function song()
    {
        return $this->belongsTo(Song::class);
    }

    public static function canVote()
    {
        return Auth::user()->voted == 0 && ! CheckHolidays::execute() && Active_voting_song::count() > 0;
    }
}
