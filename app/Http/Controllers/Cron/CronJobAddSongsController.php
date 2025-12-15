<?php

namespace App\Http\Controllers\Cron;

use App\Http\Controllers\Controller;
use App\Models\Vote;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use SpotifyWebAPI\SpotifyWebAPI; //https://github.com/jwilsson/spotify-web-api-php
use SpotifyWebAPI\Session;

class CronJobAddSongsController extends Controller
{
    public function index()
    {
        $playlist_id = config('spotify.playlist_id');

        $datum = Carbon::now()->format('Y-m-d');
        $db_query = Vote::select('songId', 'datum', DB::raw('count(id) as voteCount'))->where('datum', $datum)->groupBy("songId", "datum")->orderBy("voteCount", "DESC")->get();

        $session = new Session(
            config('spotify.client_id'),
            config('spotify.client_secret')
        );

        $session->refreshAccessToken(config('spotify.refresh_token'));
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
            $uri = "spotify:track:" . $song->songId;
            try {
                $vysledok = $api->addPlaylistTracks($playlist_id, [$uri], ['position' => $index]);
                echo 'Skladba bola úspešne pridaná!';
            } catch (Exception $e) {
                echo 'Chyba: ' . $e->getMessage();
            }
        }
    }
}