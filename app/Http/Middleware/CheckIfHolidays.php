<?php

namespace App\Http\Middleware;

use App\Models\Holiday;
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
        if (self::isHoliday()) {
            return response()->json(['message' => __('Dnes sú prázdniny')], 403);
        }

        return $next($request);
    }

    public static function isHoliday(): bool
    {
        $today = now()->toDateString();

        return Holiday::where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->exists();
    }
}
