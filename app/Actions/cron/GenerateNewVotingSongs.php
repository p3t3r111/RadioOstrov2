<?php

namespace App\Actions\cron;

use App\Models\Active_voting_song;
use App\Models\Backup_song;
use App\Models\Song;
use App\Models\User;

class GenerateNewVotingSongs
{
    public static function execute()
    {
        User::where('voted', '>', 0)->update(['voted' => 0]);
        $songVotesList = Song::where('confirmed', 1)
            ->where('weekly_played', 0)
            ->has('users')
            ->inRandomOrder()
            ->limit(12)
            ->get();

        if ($songVotesList->count() < 12) {
            $songVotesList = Backup_song::where('weekly_played', 0)
                ->inRandomOrder()
                ->limit(12)
                ->get();
        }

        Active_voting_song::truncate();
        foreach ($songVotesList as $item) {
            Active_voting_song::create([
                'song_id' => trim($item->id),
            ]);
        }
    }
}
