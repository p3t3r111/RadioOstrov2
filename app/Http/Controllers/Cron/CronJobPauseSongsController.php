<?php

namespace App\Http\Controllers\Cron;

use App\Http\Controllers\Controller;
use SpotifyWebAPI\Session; // https://github.com/jwilsson/spotify-web-api-php
use SpotifyWebAPI\SpotifyWebAPI;

class CronJobPauseSongsController extends Controller
{
    public function index()
    {
        $session = new Session(
            config('spotify.client_id'),
            config('spotify.client_secret')
        );

        $session->refreshAccessToken(config('spotify.refresh_token'));
        $accessToken = $session->getAccessToken();
        $api = new SpotifyWebAPI;
        $api->setAccessToken($accessToken);

        $devices = $api->getMyDevices();
        foreach ($devices->devices as $device) {
            if ($device->name == config('spotify.device_name')) {
                $api->pause($device->id);
            }
        }

    }
}
