<?php

namespace App\Actions;

class HandleSongTitleAutorFilter
{
    public static function execute($song, $songToUpdate = null)
    {
        $text = strtolower($song['title'].' '.$song['author']);

        $blockedKeywords = array_map(
            'trim',
            explode(',', env('SONG_TITLE_AUTHOR_BLOCKED_KEYWORDS', ''))
        );

        foreach ($blockedKeywords as $keyword) {
            if (str_contains($text, $keyword)) {
                return true;
            }
        }

        return false;
    }
}
