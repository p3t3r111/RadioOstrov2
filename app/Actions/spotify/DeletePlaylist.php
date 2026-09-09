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
        $tracks = $api->getPlaylistItems($playlist_id);
        foreach ($tracks->items as $item) {
            if (isset($item->item) && isset($item->item->uri) && ! Str::contains($item->item->name, 'radioSpeech')) {
                $track_uris[] = ['uri' => $item->item->uri];
            }
        }
        if (count($track_uris) > 0) {
            $api->deletePlaylistItems($playlist_id, $track_uris);
        }
    }
}
