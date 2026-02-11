<?php

namespace App\Actions;

use SpotifyWebAPI\Session; // https://github.com/jwilsson/spotify-web-api-php
use SpotifyWebAPI\SpotifyWebAPI;

class ConnectSpotify
{
    public static function execute()
    {
        $session = new Session(
            config('spotify.client_id'),
            config('spotify.client_secret')
        );

        $session->refreshAccessToken(config('spotify.refresh_token'));
        $accessToken = $session->getAccessToken();
        $api = new SpotifyWebAPI;
        $api->setAccessToken($accessToken);

        return $api;
    }
}
