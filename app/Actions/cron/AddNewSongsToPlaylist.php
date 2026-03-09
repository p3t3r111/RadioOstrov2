<?php

namespace App\Actions\cron;

use App\Actions\spotify\AddSongsToPlaylist;
use App\Actions\spotify\Connect;
use App\Models\Backup_song;
use App\Models\Song;
use Carbon\Carbon;
use Carbon\CarbonInterval;

class AddNewSongsToPlaylist
{
    private static function countTime($ms)
    {
        return CarbonInterval::milliseconds($ms)->cascade();
    }

    public static function execute()
    {
        $playlist_length = 0;
        $songs = [];

        $api = Connect::execute();

        $datum = Carbon::now()->addDay()->format('Y-m-d');

        $db_query = Song::withTotalWeightForDate($datum)
            ->having('total_weight', '>', 0)
            ->orderByTotalWeight()
            ->get();

        $db_query2 = Backup_song::where('weekly_played', 0)
            ->inRandomOrder()
            ->limit(12)
            ->get();

        $db_query = $db_query->merge($db_query2);

        foreach ($db_query as $song) {
            if (self::countTime($playlist_length)->totalMinutes >= 24) {
                break;
            }

            $songLength = $song->duration_ms;

            if ($songLength == 0) {
                $track = $api->getTrack($song->songId);
                $song->duration_ms = isset($track->duration_ms) ? $track->duration_ms : 0;
            }

            $song->weekly_played = 1;
            $playlist_length += $song->duration_ms;
            $songs[] = $song;
            $song->save();
        }

        AddSongsToPlaylist::execute($songs);
    }
}
