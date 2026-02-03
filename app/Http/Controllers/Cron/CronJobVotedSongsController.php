<?php

namespace App\Http\Controllers\Cron;

use App\Http\Controllers\Controller;
use App\Models\Active_voting_song;
use App\Models\Vote;
use App\Models\Voting_dates;
use Carbon\Carbon;

class CronJobVotedSongsController extends Controller
{
    public function index()
    {
        $song_query = Active_voting_song::all();

        $dateNow = Carbon::now()->format('Y-m-d');
        $dateNowUNIX = strtotime($dateNow);
        $dateIntervals = Voting_dates::all('from', 'to')->toArray();

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
        echo 'done';
    }
}
