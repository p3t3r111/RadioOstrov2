<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SpotifyWebAPI\SpotifyWebAPI; //https://github.com/jwilsson/spotify-web-api-php
use SpotifyWebAPI\Session;

class CronJobAddSongsController extends Controller
{
    public function index()
    {
        $client_id = config('spotify.client_id');
        $client_secret = config('spotify.client_secret');
        $refresh_token = config('spotify.refresh_token');
        $playlist_id = config('spotify.playlist_id');

        $datum = Carbon::now()->format('Y-m-d');
        $db_query = Vote::select('songs_id', 'datum', DB::raw('count(id) as vote_count'))->where('datum', $datum)->groupBy("songs_id", "datum")->orderBy("vote_count", "DESC")->get();

        $session = new Session(
            $client_id,
            $client_secret
        );

        $session->refreshAccessToken($refresh_token);
        $accessToken = $session->getAccessToken();
        $api = new SpotifyWebAPI();
        $api->setAccessToken($accessToken);


        // VYMAZANIE PLAYLISTU
        $track_uris = [];
        $tracks = $api->getPlaylistTracks($playlist_id);
        foreach ($tracks->items as $item) {
            if (isset($item->track) && isset($item->track->uri)) {
                $track_uris[] = ["uri" => $item->track->uri];
            }
        }
        dump($track_uris);
        if (count($track_uris) > 0) {

            $request_body = [
                'tracks' => $track_uris
            ];
            $api->deletePlaylistTracks($playlist_id, $request_body);
        }

        $datumNow = Carbon::now()->format('d.m.Y');

        $api->updatePlaylist($playlist_id, [
            'name' => 'Radio ostrov | ' . $datumNow,
        ]);

        // PRIDAVANIE pesničiek

        foreach ($db_query as $index => $song) {
            $uri = "spotify:track:" . $song->songs_id;
            try {
                $vysledok = $api->addPlaylistTracks($playlist_id, [$uri], ['position' => $index]);
                echo 'Skladba bola úspešne pridaná!';
            } catch (Exception $e) {
                echo 'Chyba: ' . $e->getMessage();
            }
        }
    }
}