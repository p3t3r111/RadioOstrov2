<?php

namespace App\Http\Controllers;

use App\Models\VotingDates;
use Carbon\Carbon;

class cronJOBvotesDATESController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        $thursdayThisWeek = $now->copy()->startOfWeek(Carbon::THURSDAY)->format('Y-m-d');
        $sundayThisWeek = $now->copy()->endOfWeek(Carbon::SUNDAY)->format('Y-m-d');

        $mondayNextWeek = $now->copy()->addWeek()->startOfWeek(Carbon::MONDAY)->format('Y-m-d');

        $mondayStartDate = Carbon::parse($mondayNextWeek);
        for ($i = 0; $i < 5; $i++) {
            $id = $i + 1;
            if ($i == 0) {
                $dateArray = [
                    "from" => $thursdayThisWeek,
                    "to" => $sundayThisWeek
                ];
                VotingDates::find($id)->update($dateArray);
                continue;
            }
            $fromDate = $mondayStartDate->copy()->subDay();
            $toDate = $mondayStartDate->copy();
            $dateArray = [
                "from" => $fromDate->format('Y-m-d'),
                "to" => $toDate->format('Y-m-d')
            ];
            VotingDates::find($id)->update($dateArray);
            $mondayStartDate->addDay();
        }
        echo "Zmenene datumy";
    }
}
