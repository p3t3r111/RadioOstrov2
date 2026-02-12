<?php

namespace App\Actions\spotify;

class CheckIfPlayingRightDevice
{
    public static function execute()
    {
        $api = Connect::execute();

        $device = CheckSpotifyDevice::execute();
        if (! $device) {
            return false;
        }

        $playback = $api->getMyCurrentPlaybackInfo();
        if ($playback && $playback->device->id == $device) {
            return true;
        }

        return false;
    }
}
