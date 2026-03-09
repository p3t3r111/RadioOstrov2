<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    protected $fillable = [
        'name',
        'max_level',
        'points',
        'reward',
    ];

    protected $casts = [
        'points' => 'array',
        'reward' => 'array',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'rewards_users')->withPivot('level')->withTimestamps();
    }

    public function getLevelAttribute()
    {
        return $this->pivot->level ?? 0;
    }

    public function getPointsForLevelAttribute()
    {
        if ($this->points && count($this->points) > 1) {
            return $this->points[$this->level] ?? 0;
        }

        return $this->points[0] ?? 0;
    }

    public function getMinimumPointsForLevelAttribute()
    {
        if ($this->points && count($this->points) > 1) {
            return $this->points[$this->level - 1] ?? 0;
        }

        return 0;
    }

    public function getRewardForLevelAttribute()
    {
        if ($this->reward && count($this->reward) > 1) {
            return $this->reward[$this->level] ?? null;
        }

        return $this->reward[0] ?? null;
    }
}
