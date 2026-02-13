<?php

namespace App\Actions;

use App\Actions\spotify\GetSongLyrics;
use Log;
use OpenAI\Laravel\Facades\OpenAI;

class CheckSongByAI
{
    public static function execute(array $song): bool
    {
        $lyrics = GetSongLyrics::execute($song['songId']);
        $prompt = "
You are moderating music for a Slovak public secondary vocational school radio.

Reject songs that:
- contain sexual content
- contain hate speech
- promote violence
- are associated with extremist ideologies (including Nazism, fascism, communism, or other extremist political movements)
- are historically linked to extremist regimes or propaganda, even if the lyrics themselves seem harmless

Title: {$song['title']}
Artist: {$song['author']}
Explicit: {$song['explicit']}
Lyrics:
{$lyrics}

Respond ONLY with:
true if song can be played on the radio
or
false if the song should be rejected
";

        $response = OpenAI::responses()->create([
            'model' => 'gpt-4o-mini',
            'input' => $prompt,
            'max_output_tokens' => 16,
        ]);

        Log::info('AI moderation response (output)', ['response' => $response->output]);
        Log::info('AI moderation response', ['response' => $response->outputText]);

        return trim(strtolower($response->outputText)) === 'true';

    }
}
