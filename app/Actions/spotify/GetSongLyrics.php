<?php

namespace App\Actions\spotify;

use Log;
use SpotifyLyricsApi\Spotify;
use SpotifyLyricsApi\SpotifyException;

class GetSongLyrics
{
    public static function execute($songId)
    {
        $finalLyrics = '';

        $spotify = new Spotify('AQAoeaggW8U4K3WS5ohdUP4XqE05nzCqpdjuto57689SquXq9S-nOxKgaK6eaS1vpt3fkB3DE6TUZyL5koh6EGZHUwX7moXOneNkJSbwAYk8lv6luTqjwCjk_KaavMX6xPl2I7yVF6HSgRtTxoa7RxoKjMkppcdKSroceAcOtqDS4XVysb8T0z8xCQlR_WmJja0zW73J-ccWaQs_2SA');

        try {
            $spotify->checkTokenExpire();
            $lyrics = $spotify->getLyrics(track_id: $songId);

            foreach ($lyrics['lyrics']['lines'] as $line) {
                $finalLyrics .= $line['words']."\n";
            }

            // Log::info('Fetched lyrics for songId: '.$songId);
            // Log::info('Lyrics: '.$finalLyrics);

            return $finalLyrics;
        } catch (SpotifyException $e) {
            // Log::info('Error: '.$e->getMessage()."\n");
            // Log::info('Status Code: '.$e->getCode()."\n");

            return null;
        }
    }
}
