<?php

namespace App\Http\Controllers\Cron;

use App\Http\Controllers\Controller;
use App\Models\Backup_song;
use App\Models\Song;
use App\Models\Voting_dates;
use Carbon\Carbon;

class CronJobVotingDatesController extends Controller
{
    public function index()
    {
        Song::where('weekly_played', 1)->update(['weekly_played' => 0]);
        Backup_song::where('weekly_played', 1)->update(['weekly_played' => 0]);
        $now = Carbon::now();

        $thursdayThisWeek = $now->copy()->startOfWeek(Carbon::THURSDAY)->format('Y-m-d');
        $sundayThisWeek = $now->copy()->endOfWeek(Carbon::SUNDAY)->format('Y-m-d');

        $mondayNextWeek = $now->copy()->addWeek()->startOfWeek(Carbon::MONDAY)->format('Y-m-d');

        $mondayStartDate = Carbon::parse($mondayNextWeek);
        for ($i = 0; $i < 5; $i++) {
            $id = $i + 1;
            if ($i == 0) {
                $dateArray = [
                    'from' => $thursdayThisWeek,
                    'to' => $sundayThisWeek,
                ];
                Voting_dates::find($id)->update($dateArray);

                continue;
            }
            $fromDate = $mondayStartDate->copy()->subDay();
            $toDate = $mondayStartDate->copy();
            $dateArray = [
                'from' => $fromDate->format('Y-m-d'),
                'to' => $toDate->format('Y-m-d'),
            ];
            Voting_dates::find($id)->update($dateArray);
            $mondayStartDate->addDay();
        }
        echo 'Zmenene datumy';
    }
}
