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
        $startIp = ip2long('37.9.175.155');
        $endIp = ip2long('37.9.175.157');

        // Log::info('Client IP:', ['ip' => $request->ip()]);
        // Log::info('Client IP:', ['ip' => $clientIp]);
        // Log::info('Start IP:', ['start_ip' => $startIp]);
        // Log::info('End IP:', ['end_ip' => $endIp]);

        // Skontroluj, či IP adresa spadá do rozsahu
        if ($clientIp < $startIp || $clientIp > $endIp) {
            // Log::warning('Access denied for IP:', ['ip' => $request->ip()]);
            abort(403, 'Access denied.');
        }

        // Log::info('Access granted for IP:', ['ip' => $request->ip()]);

        return $next($request);
    }
}
