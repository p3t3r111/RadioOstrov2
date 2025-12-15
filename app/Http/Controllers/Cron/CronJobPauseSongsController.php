<?php

namespace App\Http\Controllers\Cron;

use App\Http\Controllers\Controller;
use SpotifyWebAPI\SpotifyWebAPI; //https://github.com/jwilsson/spotify-web-api-php
use SpotifyWebAPI\Session;

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
        $api = new SpotifyWebAPI();
        $api->setAccessToken($accessToken);

        $devices = $api->getMyDevices();
        foreach ($devices->devices as $device) {
            if ($device->name == "Web Player (Firefox)") {
                $deviceId = $device->id;
            }
        }

        $api->pause($deviceId);
    }
}
