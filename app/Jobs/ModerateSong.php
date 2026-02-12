<?php

namespace App\Jobs;

use App\Actions\CheckSongByAI;
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

    public function handle(): void
    {
        $song = Song::find($this->songId);

        if (! $song) {
            return;
        }

        // ak už nie je pending, nerieš
        if ($song->confirmed !== 2) {
            return;
        }

        if ($song->explicit || $song->duration_ms >= 360000) {
            $song->confirmed = -1;
            $song->save();

            return;
        }

        Log::info('Starting AI moderation for song', ['songId' => $song->id, 'title' => $song->title]);

        $canBeAdded = CheckSongByAI::execute([
            'songId' => $song->songId,
            'title' => $song->title,
            'author' => $song->author,
            'explicit' => $song->explicit,
            'duration_ms' => $song->duration_ms,
        ]);

        $song->confirmed = $canBeAdded ? 1 : -1;
        $song->save();
    }
}
