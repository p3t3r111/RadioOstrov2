<?php

namespace App\Http\Controllers\Cron;

use App\Http\Controllers\Controller;
use SpotifyWebAPI\SpotifyWebAPI; //https://github.com/jwilsson/spotify-web-api-php
use SpotifyWebAPI\Session;

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
        $api = new SpotifyWebAPI();
        $api->setAccessToken($accessToken);
        
        $devices = $api->getMyDevices();
        foreach ($devices->devices as $device) {
            if ($device->name == "Web Player (Firefox)") {
                $deviceId = $device->id;
            }
        }
        
        $api->play($deviceId, [
            'context_uri' => "spotify:playlist:$playlist_id",
        ]);

    }
}
