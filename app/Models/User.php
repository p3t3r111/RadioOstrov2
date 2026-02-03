<?php

namespace App\Models;

use App\Actions\CheckHolidays;
use Carbon\Carbon;
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

    public function canVote()
    {
        return $this->voted < $this->max_votes_per_day && ! CheckHolidays::execute() && Active_voting_song::count() > 0;
    }

    public function songs()
    {
        return $this->belongsToMany(Song::class, 'user_songs')->withPivot('id')->orderBy('pivot_id', 'asc');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function markVoted(int $votes): void
    {
        $this->incrementEach([
            'voted' => $votes,
            'votes' => $votes,
        ]);
    }

    public function unMarkVoted(int $votes): void
    {
        $this->decrementEach([
            'voted' => $votes,
            'votes' => $votes,
        ]);
    }

    public function getSongsCount()
    {
        return $this->songs()->count();
    }

    public function activeVotedSongs()
    {
        $votingDate = Voting_dates::activeVotingDate();
        $votingDay = Carbon::parse($votingDate->to)->addDay()->format('Y-m-d');

        return $this->votes()
            ->where('datum', $votingDay)
            ->where('user_id', $this->id)
            ->get();
    }
}
