<?php

namespace App\Actions\spotify;

use Log;

class PausePlaying
{
    public static function execute()
    {
        $api = Connect::execute();

        $device = CheckSpotifyDevice::execute();
        if (! $device) {
            Log::critical('No active Spotify device found. Cannot pause songs. Device: '.$device);

            return;
        }

        $api->pause($device);
    }
}
