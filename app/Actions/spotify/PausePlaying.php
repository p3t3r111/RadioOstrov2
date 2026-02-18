<?php

namespace App\Actions\spotify;

use Log;
use SpotifyWebAPI\SpotifyWebAPIException;

class PausePlaying
{
    public static function execute()
    {
        $api = Connect::execute();

        $device = CheckSpotifyDevice::execute();
        if (! $device) {
            Log::critical('No active Spotify device found. Cannot pause songs. Device: '.$device);

            return;
        }

        $maxRetries = 3;
        $retryDelay = 1; // seconds

        for ($attempt = 1; $attempt <= $maxRetries; $attempt++) {
            try {
                $api->pause($device);

                if ($attempt > 1) {
                    Log::info("Successfully paused Spotify playback on attempt {$attempt}");
                }

                return;
            } catch (SpotifyWebAPIException $e) {
                $statusCode = $e->getCode();
                $message = $e->getMessage();

                // For transient errors (502, 503, 504), retry
                if (in_array($statusCode, [502, 503, 504]) && $attempt < $maxRetries) {
                    Log::warning("Spotify API returned {$statusCode} ({$message}). Retrying in {$retryDelay}s... (Attempt {$attempt}/{$maxRetries})");
                    sleep($retryDelay);
                    $retryDelay *= 2; // Exponential backoff

                    continue;
                }

                // For other errors or final retry failure, log and return gracefully
                Log::error("Failed to pause Spotify playback after {$attempt} attempt(s). Status: {$statusCode}, Message: {$message}");

                return;
            }
        }
    }
}
