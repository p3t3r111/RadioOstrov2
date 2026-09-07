<?php

namespace App\Actions\spotify;

use Carbon\Carbon;
use Exception;
use Log;

class AddSongsToPlaylist
{
    public static function execute($songs)
    {
        $api = Connect::execute();
        $playlist_id = config('spotify.playlist_id');
        $datum = Carbon::now()->addDay()->format('d.m.Y');

        DeletePlaylist::execute($songs);

        $api->updatePlaylist($playlist_id, [
            'name' => 'Radio ostrov | '.$datum,
        ]);

        foreach ($songs as $index => $song) {

            $uri = 'spotify:track:'.$song->songId;
            try {
                $api->addPlaylistItems($playlist_id, [$uri], ['position' => $index + 1]);
            } catch (Exception $e) {
                Log::error('SPOTIFY : Chyba při přidávání skladby do playlistu: '.$e->getMessage());
            }
        }
    }
}
