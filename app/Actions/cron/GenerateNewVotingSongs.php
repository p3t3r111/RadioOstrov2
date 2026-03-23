<?php

namespace App\Actions\cron;

use App\Models\Active_voting_song;
use App\Models\Backup_song;
use App\Models\Song;

class GenerateNewVotingSongs
{
    public static function execute()
    {
        $songVotesList = Song::where('confirmed', 1)
            ->where('weekly_played', 0)
            ->has('users')
            ->inRandomOrder()
            ->limit(12)
            ->get();

        if ($songVotesList->count() < 12) {
            Song::where('confirmed', 1)
                ->update(['weekly_played' => 0]);

            $remaining = 12 - $songVotesList->count();

            $songVotesList2 = Song::where('confirmed', 1)
                ->where('weekly_played', 0)
                ->has('users')
                ->inRandomOrder()
                ->limit($remaining)
                ->get();

            $songVotesList = $songVotesList->merge($songVotesList2);

        }

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
