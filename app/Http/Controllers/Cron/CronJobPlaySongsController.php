<?php

namespace App\Http\Controllers\Cron;

use App\Actions\spotify\CheckSpotifyDevice;
use App\Actions\spotify\Connect;
use App\Http\Controllers\Controller;
use Log;

class CronJobPlaySongsController extends Controller
{
    public function index()
    {
        $playlist_id = config('spotify.playlist_id');

        $api = Connect::execute();

        $device = CheckSpotifyDevice::execute();
        if (! $device) {
            Log::critical('No active Spotify device found. Cannot play songs. Device: '.$device);

            return;
        }

        $api->play($device, [
            'context_uri' => "spotify:playlist:$playlist_id",
        ]);

    }
}
