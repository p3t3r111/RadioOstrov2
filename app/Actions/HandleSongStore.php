<?php

namespace App\Actions;

use App\Jobs\ModerateSong;
use App\Models\Song;
use Auth;
use DB;
use Log;

class HandleSongStore
{
    public static function execute($song, $songToUpdate = null)
    {
        $user = Auth::user();

        if (! $song) {
            $user->songs()->detach();

            return;
        }

        $songArr = [
            'songId' => $song['songId'],
            'author' => $song['author'],
            'title' => $song['title'],
            'img_path' => $song['imgPath'],
            'duration_ms' => $song['duration_ms'] ?? 0,
        ];

        DB::transaction(function () use ($user, $songArr, $songToUpdate) {
            $existingSong = Song::where('songId', $songArr['songId'])
                ->lockForUpdate()
                ->first();

            if (! $existingSong) {
                $existingSong = Song::create($songArr);
            }

            if ($existingSong->confirmed == 0) {
                $existingSong->confirmed = 2;
                $existingSong->save();

                Log::info('Dispatching ModerateSong job for new song', ['songId' => $existingSong->id, 'title' => $existingSong->title]);

                ModerateSong::dispatch($existingSong->id);
            }

            if ($songToUpdate) {
                $user->songs()->detach($songToUpdate->id);
            }

            $user->songs()->syncWithoutDetaching([$existingSong->id]);
        });
    }
}
