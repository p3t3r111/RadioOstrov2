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
        'all_time_points',
        'reserved_points',
        'used_points',
        'locale',
        'theme',
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
        static::created(function ($user) {

            logger('USER CREATED EVENT FIRED');
            $data = Reward::all()->mapWithKeys(fn ($reward) => [
                $reward->id => ['level' => 0],
            ])->toArray();
            logger('ATTACHING REWARDS TO USER', $data);

            $user->rewards()->attach($data);
        });
    }

    public function rewards()
    {
        return $this->belongsToMany(Reward::class, 'rewards_users')->withPivot('level')->withTimestamps();
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
        $this->increment('voted', $votes);
        $this->increment('votes', $votes);
    }

    public function unMarkVoted(int $votes): void
    {
        $this->decrement('voted', $votes);
        $this->decrement('votes', $votes);
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

    public function rewardCards()
    {
        // get Reward by user required
    }
}
