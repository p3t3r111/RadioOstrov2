<?php

namespace App\Actions;

use File;

class GetAvailableLocales
{
    /**
     * Create a new class instance.
     */
    public static function execute()
    {
        $path = base_path('lang');

        if (! File::exists($path)) {
            return [];
        }

        return collect(File::directories($path))
            ->filter(function ($dir) {
                return basename($dir) !== config('app.locale');
            })
            ->map(function ($dir) {
                if (basename($dir) == 'en') {
                    return ['code' => 'en', 'flag' => 'gb'];
                }

                return ['code' => basename($dir), 'flag' => basename($dir)];
            })
            ->values()
            ->toArray();
    }
}
