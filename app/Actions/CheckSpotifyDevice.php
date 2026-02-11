<?php

namespace App\Actions;

class CheckSpotifyDevice
{
    public static function execute()
    {
        $api = ConnectSpotify::execute();

        $devices = $api->getMyDevices();
        foreach ($devices->devices as $device) {
            if ($device->name == config('spotify.device_name')) {
                return $device->id;
            }
        }

        return false;
    }
}
