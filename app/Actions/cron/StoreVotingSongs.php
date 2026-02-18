<?php

namespace App\Actions\cron;

use App\Models\Active_voting_song;
use App\Models\Vote;
use App\Models\Voting_dates;
use Carbon\Carbon;

class StoreVotingSongs
{
    public static function execute()
    {
        $song_query = Active_voting_song::all();
        $activeVotingDay = Voting_dates::activeVotingDate();
        $votingDateNEW = Carbon::parse($activeVotingDay->to)
            ->addDay()
            ->format('Y-m-d');

        foreach ($song_query as $song) {
            Vote::create([
                'datum' => $votingDateNEW,
                'user_id' => 1,
                'song_id' => $song->song_id,
                'vote_weight' => 1,
                'vote_count' => 1,
            ]);

        }
    }
}
