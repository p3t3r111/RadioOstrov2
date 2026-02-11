<?php

namespace App\Actions;

class PausePlaying
{
    public static function execute()
    {
        $api = ConnectSpotify::execute();

        $device = CheckSpotifyDevice::execute();
        if (! $device) {
            return;
        }

        $api->pause($device);
    }
}
