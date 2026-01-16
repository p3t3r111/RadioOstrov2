<?php

namespace App\Http\Controllers\Cron;

use App\Http\Controllers\Controller;
use SpotifyWebAPI\Session; // https://github.com/jwilsson/spotify-web-api-php
use SpotifyWebAPI\SpotifyWebAPI;

class CronJobPlaySongsController extends Controller
{
    public function index()
    {
        $playlist_id = config('spotify.playlist_id');

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
            @dump(config('spotify.device_name'));
            if ($device->name == config('spotify.device_name')) {
                $api->play($device->id, [
                    'context_uri' => "spotify:playlist:$playlist_id",
                ]);
            }
        }

    }
}
