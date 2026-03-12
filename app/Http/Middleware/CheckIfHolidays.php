<?php

namespace App\Http\Middleware;

use App\Actions\isHolidays;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIfHolidays
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (isHolidays::execute(now(), true)) {
            abort(403, 'Dnes sú prázdniny');
        }

        return $next($request);
    }
}
