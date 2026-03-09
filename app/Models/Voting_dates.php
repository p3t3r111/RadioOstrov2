<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voting_dates extends Model
{
    use HasFactory;

    protected $fillable = [
        'from',
        'to',
    ];

    public static function activeVoting()
    {
        $dateIntervals = Voting_dates::all();

        foreach ($dateIntervals as $dateInterval) {
            $from = Carbon::createFromFormat('Y-m-d', $dateInterval->from)
                ->setTime(config('app.voting_hours'), 0, 0);
            $fromUNIX = $from->timestamp;

            $to = Carbon::createFromFormat('Y-m-d', $dateInterval->to)
                ->setTime(config('app.voting_hours'), 0, 0);
            $toUNIX = $to->timestamp;

            $dateNowUNIX = Carbon::now()->timestamp;

            if ($dateNowUNIX >= $fromUNIX && $dateNowUNIX <= $toUNIX) {
                return $dateInterval;
            }
        }

        return null;
    }

    public static function activeVotingDate()
    {
        $activeVotingDate = self::activeVoting();

        return Carbon::parse($activeVotingDate->to)->addDay()->toDateString();
    }
}
