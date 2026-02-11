<?php

namespace App\Http\Controllers\Cron;

use App\Actions\CheckSpotifyDevice;
use App\Actions\ConnectSpotify;
use App\Http\Controllers\Controller;

class CronJobPlaySongsController extends Controller
{
    public function index()
    {
        $playlist_id = config('spotify.playlist_id');

        $api = ConnectSpotify::execute();

        $device = CheckSpotifyDevice::execute();
        if (! $device) {
            return;
        }

        $api->play($device, [
            'context_uri' => "spotify:playlist:$playlist_id",
        ]);

    }
}
