<?php

namespace App\Actions\spotify;

class PausePlaying
{
    public static function execute()
    {
        $api = Connect::execute();

        $device = CheckSpotifyDevice::execute();
        if (! $device) {
            return;
        }

        $api->pause($device);
    }
}
