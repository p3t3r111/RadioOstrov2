<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\Voting_dates;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $dayOfWeek = null;
        $canVote = Vote::canVote();
        $exportDates = [];

        $dateNow = Carbon::now()->format('Y-m-d H:i:s');
        $dateNowUNIX = strtotime(datetime: $dateNow);
        $dateIntervals = Voting_dates::all('from', 'to')->toArray();
        foreach ($dateIntervals as $dateInterval) {
            $dateInterval['from'] = Carbon::createFromFormat('Y-m-d', $dateInterval['from'])->setTime(config('app.voting_hours'), 0, 0);
            $dateInterval['to'] = Carbon::createFromFormat('Y-m-d', $dateInterval['to'])->setTime(config('app.voting_hours'), 0, 0);

            $fromUNIX = strtotime($dateInterval['from']);
            $toUNIX = strtotime($dateInterval['to']);

            $fromDate = $dateInterval['from']->format('d.m.Y');
            $toDate = $dateInterval['to']->format('d.m.Y');

            // $dateNames = Carbon::getDays();
            $datesName = [
                0 => 'Pondelok',
                1 => 'Utorok',
                2 => 'Streda',
                3 => 'Štvrtok',
                4 => 'Piatok',
            ];

            if ($dateNowUNIX >= $fromUNIX && $dateNowUNIX <= $toUNIX) {
                $votingDateUNIX = $toUNIX + 86400;
                $dayOfWeek = date('w', $votingDateUNIX);
            }

            $exportDates[] = [
                'from' => $fromDate,
                'to' => $toDate,
                'name' => $datesName[count($exportDates)],
            ];
        }

        return View('index', ['canVote' => $canVote, 'activeVotingDay' => $dayOfWeek, 'votingDates' => $exportDates]);
    }
}
