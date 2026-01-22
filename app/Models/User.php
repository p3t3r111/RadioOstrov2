<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Str;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'google_token',
        'google_refresh_token',
        'email_verified_at',
        'voted',
        'votes',
        'invited_people',
        'vote_weight',
        'max_favorite_songs',
        'max_votes_per_day',
        'referred_by',
    ];

    protected $guarded = ['referral_code'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function booted()
    {
        static::creating(function ($user) {
            if (! $user->referral_code) {
                do {
                    $code = Str::upper(Str::random(8));
                } while (
                    self::where('referral_code', $code)->exists()
                );

                $user->referral_code = $code;
            }
        });
    }

    public function songs()
    {
        return $this->belongsToMany(Song::class, 'user_songs')->withPivot('id')->orderBy('pivot_id', 'asc');
    }

    public function markVoted(): void
    {
        $this->update(['voted' => 1]);
        $this->increment('votes');
    }
}
