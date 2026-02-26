<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    protected $table = 'songs';

    protected $fillable = [
        'title',
        'songId',
        'author',
        'img_path',
        'weekly_played',
        'duration_ms',
        'explicit',
        'confirmed',
        'moderation_reason',
    ];

    public function scopeWithTotalWeightForDate($query, $date)
    {
        return $query->withSum([
            'votes as total_weight' => function ($q) use ($date) {
                $q->whereDate('datum', $date);
            },
        ], DB::raw('vote_count * vote_weight'));
    }

    public function scopeOrderByTotalWeight($query)
    {
        return $query->orderByDesc('total_weight');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_songs');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'song_id', 'id');
    }

    public function activeVotingSong()
    {
        return $this->hasOne(Active_voting_song::class, 'song_id', 'id');
    }
}
