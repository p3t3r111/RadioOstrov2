<?php

namespace App\Actions;

use App\Actions\spotify\GetSongLyrics;
use Log;
use OpenAI\Laravel\Facades\OpenAI;

class CheckSongByAI
{
    public static function execute(array $song)
    {

        $lyrics = GetSongLyrics::execute($song['songId']);

        if (! $lyrics) {
            Log::info("Lyrics missing for {$song['title']} — sending to human review");

            return [
                'approved' => 0,
                'reason' => 'Lyrics not found – requires human review',
            ];
        }

        $prompt = "
You are moderating music for a Slovak public secondary school radio (students aged 15–19).

Only real musical songs are allowed.

Reject the track if it is:

- ASMR content
- spoken word, podcast episode, speech, or motivational talk
- political speech or commentary
- pure sound effects (rain, white noise, nature sounds)
- meditation or binaural beats without musical structure
- any non-musical audio content

Instrumental music is allowed if it is clearly a musical composition.

Also reject songs ONLY if they:

- describe explicit sexual acts in a detailed or graphic way
- contain strong vulgar language
- promote violence or self-harm
- contain hate speech
- promote extremist ideologies
- are historically associated with extremist propaganda

Mild romantic themes or non-graphic references are acceptable.

Title: {$song['title']}
Artist: {$song['author']}
Explicit flag from Spotify: {$song['explicit']}
Lyrics:
{$lyrics}

Respond ONLY in valid JSON in this format:

{
  \"approved\": true or false,
  \"reason\": \"short explanation\"
}
";

        $response = OpenAI::responses()->create([
            'model' => 'gpt-4o-mini',
            'input' => $prompt,
            'max_output_tokens' => 200,
            'text' => [
                'format' => [
                    'type' => 'json_object',
                ],
            ],
        ]);

        $content = $response->outputText ?? '';
        $data = json_decode($content, true);

        // fallback ochrana
        if (! is_array($data) || ! isset($data['approved'])) {
            Log::warning('Invalid AI response for song '.$song['title'], [
                'response' => $content,
            ]);

            return [
                'approved' => 0,
                'reason' => 'Invalid AI response',
            ];
        }

        return [
            'approved' => (bool) $data['approved'],
            'reason' => $data['reason'] ?? null,
        ];

    }
}
