<?php

namespace App\Actions;

use App\Models\Holiday;
use Carbon\Carbon;

class CheckHolidays
{
    public static function execute()
    {
        $today = now()->toDateString();

        $holiday = Holiday::where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->get();

        if ($holiday->isEmpty()) {
            return false;
        }

        if ($holiday) {
            $startDate = Carbon::parse($holiday->first()->start_date)->setTime(14, 0)->timestamp;
            $endDate = Carbon::parse($holiday->first()->end_date)->setTime(14, 0)->timestamp;
            if ($startDate >= now()->timestamp && now()->timestamp >= $endDate) {
                return false;
            }
        }

        return true;
    }
}
