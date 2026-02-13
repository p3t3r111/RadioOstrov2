<?php

namespace App\Http\Controllers\Cron;

use App\Actions\spotify\Connect;
use App\Http\Controllers\Controller;
use App\Models\Backup_song;
use App\Models\Song;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Exception;
use Illuminate\Support\Str;

class CronJobAddSongsController extends Controller
{
    private function countTime($ms)
    {
        return CarbonInterval::milliseconds($ms)->cascade();
    }

    public function index()
    {
        $playlist_id = config('spotify.playlist_id');
        $playlist_length = 0;
        $songs = [];

        $api = Connect::execute();

        $datum = Carbon::now()->addDay()->format('Y-m-d');
        $db_query = Song::withCount([
            'votes as voteCount' => fn ($q) => $q->whereDate('datum', $datum),
        ])
            ->having('voteCount', '>', 0)
            ->orderByDesc('voteCount')
            ->get();

        $db_query2 = Backup_song::where('weekly_played', 0)
            ->inRandomOrder()
            ->limit(12)
            ->get();

        $db_query = $db_query->merge($db_query2);

        foreach ($db_query as $song) {
            if ($this->countTime($playlist_length)->totalMinutes >= 24) {
                break;
            }

            if ($song) {
                $songLength = $song->duration_ms;
                if ($songLength == 0) {
                    $track = $api->getTrack($song->songId);
                    $song->duration_ms = isset($track->duration_ms) ? $track->duration_ms : 0;
                }
                $song->weekly_played = 1;
                $playlist_length += $song->duration_ms;
                $songs[] = $song;
                $song->save();
            }
        }

        // VYMAZANIE PLAYLISTU
        $track_uris = [];
        $tracks = $api->getPlaylistTracks($playlist_id);
        foreach ($tracks->items as $item) {
            if (isset($item->track) && isset($item->track->uri) && ! Str::contains($item->track->name, 'radioSpeech')) {
                $track_uris[] = ['uri' => $item->track->uri];
            }
        }
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
        foreach ($songs as $index => $song) {

            $uri = 'spotify:track:'.$song->songId;
            try {
                $api->addPlaylistTracks($playlist_id, [$uri], ['position' => $index + 1]);
                echo 'Skladba bola úspešne pridaná!';
            } catch (Exception $e) {
                echo 'Chyba: '.$e->getMessage();
            }
        }
    }
}
