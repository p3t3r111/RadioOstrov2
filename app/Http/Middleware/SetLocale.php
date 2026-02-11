<?php

namespace App\Http\Middleware;

use Closure;
use File;
use Illuminate\Http\Request;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $availableLocales = collect(File::directories(lang_path()))
            ->map(fn ($dir) => basename($dir))
            ->toArray();

        if (auth()->check() && ! empty(auth()->user()->locale)) {
            $locale = auth()->user()->locale;
        } elseif (session()->has('locale')) {
            $locale = session('locale');
        } else {
            $locale = $request->getPreferredLanguage($availableLocales);
            session(['locale' => $locale]);
        }

        app()->setLocale($locale ?? config('app.locale'));

        return $next($request);
    }
}
