<?php

namespace App\Http\Controllers\Cron;

use App\Http\Controllers\Controller;
use App\Models\Active_voting_song;
use App\Models\Backup_song;
use App\Models\Song;
use App\Models\User;

class CronJobVotingSongsController extends Controller
{
    public function index()
    {
        User::where('voted', 1)->update(['voted' => 0]);

        // user songs
        $songVotesList = Song::where('confirmed', 1)
            ->where('weekly_played', 0)
            ->has('users')
            ->inRandomOrder()
            ->limit(10)
            ->get();

        if ($songVotesList->count() < 10) {
            $songVotesList = Backup_song::where('weekly_played', 0)
                ->inRandomOrder()
                ->limit(10)
                ->get();
        }

        Active_voting_song::truncate();
        foreach ($songVotesList as $item) {
            Active_voting_song::create([
                'song_id' => trim($item->id),
            ]);
        }

        dd('done');
    }
}
