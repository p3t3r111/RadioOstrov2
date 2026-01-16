<?php

namespace App\Actions;

use App\Models\Holiday;

class CheckHolidays
{
    public static function execute()
    {
        $today = now()->toDateString();

        $holiday = Holiday::where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->exists();

        if (! $holiday) {
            return false;
        }

        return true;
    }
}
