<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class VerifyCronRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $clientIp = ip2long($request->ip()); // Prevod IP adresy na číselný formát

        // Definuj rozsah IP adries (od-do)
        $startIp = ip2long(config('app.cron_ip_start'));
        $endIp = ip2long(config('app.cron_ip_end') ?? config('app.cron_ip_start'));

        // Skontroluj, či IP adresa spadá do rozsahu
        if ($clientIp < $startIp || $clientIp > $endIp) {
            Log::warning('Access denied for IP:', ['ip' => $request->ip()]);
            abort(403, 'Access denied.');
        }

        return $next($request);
    }
}
