<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SpotifyWebAPI\SpotifyWebAPI; //https://github.com/jwilsson/spotify-web-api-php
use SpotifyWebAPI\Session;

class CronJobPlaySongsController extends Controller
{
    public function index()
    {
        $client_id = config('spotify.client_id');
        $client_secret = config('spotify.client_secret');
        $refresh_token = config('spotify.refresh_token');
        $playlist_id = config('spotify.playlist_id');
        $deviceId = config('spotify.device_id');

        $session = new Session(
            $client_id,
            $client_secret
        );

        $session->refreshAccessToken($refresh_token);
        $accessToken = $session->getAccessToken();
        $api = new SpotifyWebAPI();
        $api->setAccessToken($accessToken);

        $api->play($deviceId, [
            'context_uri' => 'spotify:playlist:' . $playlist_id,
        ]);
    }
}
