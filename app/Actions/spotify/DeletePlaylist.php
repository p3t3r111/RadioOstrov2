<?php

namespace App\Actions\spotify;

use Str;

class DeletePlaylist
{
    public static function execute($songs)
    {
        $playlist_id = config('spotify.playlist_id');
        $api = Connect::execute();

        $track_uris = [];
        $tracks = $api->getPlaylistTracks($playlist_id);
        foreach ($tracks->items as $item) {
            if (isset($item->track) && isset($item->track->uri) && ! Str::contains($item->track->name, 'radioSpeech')) {
                $track_uris[] = ['uri' => $item->track->uri];
            }
        }
        if (count($track_uris) > 0) {

            $request_body = [
                'tracks' => $track_uris,
            ];
            $api->deletePlaylistTracks($playlist_id, $request_body);
        }
    }
}
