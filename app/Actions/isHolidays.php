<?php

namespace App\Actions;

use App\Models\Holiday;
use App\Models\Voting_dates;
use Carbon\Carbon;

class isHolidays
{
    public static function execute($date, $cronCall = false)
    {
        $holiday = Holiday::whereDate('start_date', '<=', $date)
            ->whereDate('end_date', '>=', $date)
            ->get();

        if ($holiday->isNotEmpty()) {
            $voting = Voting_dates::activeVoting();

            $startDate = Carbon::parse($voting->from)->setTime(14, 0);
            $endDate = Carbon::parse($voting->to)->setTime(14, 0);
            $now = now();

            if ($now->between($startDate, $endDate)) {
                return true;
            }
        }

        return false;
    }
}
