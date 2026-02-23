<?php

namespace App\Jobs;

use App\Actions\CheckSongByAI;
use App\Actions\HandleSongTitleAutorFilter;
use App\Actions\spotify\Connect;
use App\Models\Song;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Log;

class ModerateSong implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $songId;

    public function __construct(int $songId)
    {
        $this->songId = $songId;
    }

    public int $tries = 1; // zabráni retry loop

    public function handle(): void
    {
        $song = Song::find($this->songId);

        if (! $song) {
            return;
        }

        try {

            $songLength = $song->duration_ms;

            if ($songLength == 0) {
                try {
                    $api = Connect::execute();
                    $track = $api->getTrack($song->songId);
                    $song->duration_ms = $track->duration_ms ?? 0;
                    $songLength = $song->duration_ms;
                    $song->save();
                } catch (\Throwable $e) {

                    Log::error('Spotify duration fetch failed', [
                        'song_id' => $song->id,
                        'error' => $e->getMessage(),
                    ]);

                    $song->confirmed = 0;
                    $song->moderation_reason = 'Spotify API error – human review required';
                    $song->save();

                    return;
                }
            }

            $songExplicit = $song->explicit;
            if ($songExplicit == 0) {
                $track = $api->getTrack($song->songId);
                $song->explicit = $track->explicit ?? 0;
                $song->save();
            }

            if ($song->explicit || $songLength >= 360000) {
                $song->confirmed = -1;
                $song->moderation_reason = $song->explicit
                    ? 'Explicit flag from Spotify'
                    : 'Song duration exceeds 6 minutes';
                $song->save();

                return;
            }

            if (HandleSongTitleAutorFilter::execute($song->toArray())) {
                Log::info("Song {$song->title} blocked by title/author filter");
                $song->confirmed = -1;
                $song->moderation_reason = 'Blocked keyword in title or author';
                $song->save();

                return;
            }

            $aiResponse = CheckSongByAI::execute([
                'songId' => $song->songId,
                'title' => $song->title,
                'author' => $song->author,
                'explicit' => $song->explicit,
                'duration_ms' => $song->duration_ms,
            ]);

            if (! isset($aiResponse['approved'])) {
                throw new \Exception('Invalid AI response structure');
            }

            if ($aiResponse['approved'] === 0) {
                $song->confirmed = 0;
            } else {
                $song->confirmed = $aiResponse['approved'] ? 1 : -1;
            }

            if ($song->confirmed != 1) {
                $song->moderation_reason = $aiResponse['reason'] ?? 'Rejected without reason';
            }
            Log::info('Moderation result for song '.$song->title.': '.($song->confirmed == 1 ? 'approved' : ($song->confirmed == -1 ? 'rejected' : 'needs review')).' – reason: '.$song->moderation_reason);
            $song->save();

        } catch (\Throwable $e) {

            Log::critical('Moderation job crashed', [
                'song_id' => $song->id,
                'error' => $e->getMessage(),
            ]);

            $song->confirmed = 0;
            $song->moderation_reason = 'System error – requires human review';
            $song->save();
        }
    }
}
