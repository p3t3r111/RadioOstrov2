<?php

namespace App\Http\Middleware;

use App\Actions\CheckHolidays;
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
        if (CheckHolidays::execute(true)) {
            abort(403, 'Dnes sú prázdniny');
        }

        return $next($request);
    }
}
