<?php

namespace App\Http\Controllers;

use App\Models\Voting_dates;
use Auth;
use Carbon\Carbon;
use Str;

class HomeController extends Controller
{
    public function index()
    {

        $canVote = Auth::user()->canVote();
        $dateIntervals = Voting_dates::all('from', 'to')->map(function ($item) {
            $votingDate = Carbon::createFromFormat('Y-m-d', $item->to)->addDay();

            return [
                'from' => Carbon::createFromFormat('Y-m-d', $item['from'])->format('d.m.Y'),
                'to' => Carbon::createFromFormat('Y-m-d', $item['to'])->format('d.m.Y'),
                'name' => Str::ucfirst($votingDate->translatedFormat('l')),
                'votingDate' => $votingDate->format('d.m.Y'),
            ];
        });

        $dayOfWeek = Voting_dates::activeVotingDate();

        return View('index', ['canVote' => $canVote, 'activeVotingDay' => $dayOfWeek, 'votingDates' => $dateIntervals]);
    }
}
