<?php

namespace App\Http\Controllers\Cron;

use App\Http\Controllers\Controller;
use App\Models\Backup_song;
use App\Models\Song;
use App\Models\Vote;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use SpotifyWebAPI\Session; // https://github.com/jwilsson/spotify-web-api-php
use SpotifyWebAPI\SpotifyWebAPI;

class CronJobAddSongsController extends Controller
{
    private function countTime($ms)
    {
        return CarbonInterval::milliseconds($ms)->cascade();
    }

    public function index()
    {
        $playlist_id = config('spotify.playlist_id');

        $datum = Carbon::now()->format('Y-m-d');
        $db_query = Vote::select('songId', 'datum', DB::raw('count(id) as voteCount'))->where('datum', $datum)->groupBy('songId', 'datum')->orderBy('voteCount', 'DESC')->get();

        $session = new Session(
            config('spotify.client_id'),
            config('spotify.client_secret')
        );

        $session->refreshAccessToken(config('spotify.refresh_token'));
        $accessToken = $session->getAccessToken();
        $api = new SpotifyWebAPI;
        $api->setAccessToken($accessToken);

        // VYMAZANIE PLAYLISTU
        $track_uris = [];
        $tracks = $api->getPlaylistTracks($playlist_id);
        foreach ($tracks->items as $item) {
            if (isset($item->track) && isset($item->track->uri) && ! Str::contains($item->track->name, 'radioSpeech')) {
                $track_uris[] = ['uri' => $item->track->uri];
            }
        }
        dump($track_uris);
        if (count($track_uris) > 0) {

            $request_body = [
                'tracks' => $track_uris,
            ];
            $api->deletePlaylistTracks($playlist_id, $request_body);
        }

        $datum2 = Carbon::parse($datum)->format('d.m.Y');

        $api->updatePlaylist($playlist_id, [
            'name' => 'Radio ostrov | '.$datum2,
        ]);

        // PRIDAVANIE pesničiek

        $playlist_length = 0;
        foreach ($db_query as $index => $song) {
            if ($this->countTime($playlist_length)->totalMinutes >= 24) {
                break;
            }

            $uri = 'spotify:track:'.$song->songId;
            $songModel = Song::where('songId', $song->songId)->first();
            if (! $songModel) {
                $songModel = Backup_song::where('songId', $song->songId)->first();
            }
            try {
                $api->addPlaylistTracks($playlist_id, [$uri], ['position' => $index + 1]);
                echo 'Skladba bola úspešne pridaná!';
                if ($songModel) {
                    $songLength = $songModel->duration_ms;
                    if ($songLength == 0) {
                        $track = $api->getTrack($song->songId);
                        $songModel->duration_ms = isset($track->duration_ms) ? $track->duration_ms : 0;
                    }
                    $playlist_length += $songModel->duration_ms;
                    $songModel->weekly_played = 1;
                    $songModel->save();
                }
            } catch (Exception $e) {
                echo 'Chyba: '.$e->getMessage();
            }
        }
    }
}
