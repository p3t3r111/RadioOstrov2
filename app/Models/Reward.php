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
}
