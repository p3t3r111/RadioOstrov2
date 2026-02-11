<?php

namespace App\Actions\spotify;

class CheckSpotifyDevice
{
    public static function execute()
    {
        $api = Connect::execute();

        $devices = $api->getMyDevices();
        foreach ($devices->devices as $device) {
            if ($device->name == config('spotify.device_name')) {
                return $device->id;
            }
        }

        return false;
    }
}
