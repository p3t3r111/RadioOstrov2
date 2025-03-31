<?php

namespace App\Http\Controllers;

use App\Models\VotingDates;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{

    public function authCheck()
    {
        $dayOfWeek = null;
        $dateNow = Carbon::now()->format('Y-m-d');
        $dateNowUNIX = strtotime($dateNow);
        $dateIntervals = VotingDates::all("from", "to")->toArray();
        foreach ($dateIntervals as $dateInterval) {
            $fromUNIX = strtotime($dateInterval["from"]);
            $toUNIX = strtotime($dateInterval["to"]);

            if ($dateNowUNIX >= $fromUNIX && $dateNowUNIX <= $toUNIX) {
                $votingDateUNIX = $toUNIX + 86400;
                $dayOfWeek = date("w", $votingDateUNIX);
                break;
            }
        }

        $mondayFROM = $dateIntervals[0]["from"];
        $mondayFROM = Carbon::createFromFormat('Y-m-d', $mondayFROM)->format('d.m.Y');
        $mondayTO = $dateIntervals[0]["to"];
        $mondayTO = Carbon::createFromFormat('Y-m-d', $mondayTO)->format('d.m.Y');
        $tuesdayFROM = $dateIntervals[1]["from"];
        $tuesdayFROM = Carbon::createFromFormat('Y-m-d', $tuesdayFROM)->format('d.m.Y');
        $tuesdayTO = $dateIntervals[1]["to"];
        $tuesdayTO = Carbon::createFromFormat('Y-m-d', $tuesdayTO)->format('d.m.Y');
        $wednesdayFROM = $dateIntervals[2]["from"];
        $wednesdayFROM = Carbon::createFromFormat('Y-m-d', $wednesdayFROM)->format('d.m.Y');
        $wednesdayTO = $dateIntervals[2]["to"];
        $wednesdayTO = Carbon::createFromFormat('Y-m-d', $wednesdayTO)->format('d.m.Y');
        $thursdayFROM = $dateIntervals[3]["from"];
        $thursdayFROM = Carbon::createFromFormat('Y-m-d', $thursdayFROM)->format('d.m.Y');
        $thursdayTO = $dateIntervals[3]["to"];
        $thursdayTO = Carbon::createFromFormat('Y-m-d', $thursdayTO)->format('d.m.Y');
        $fridayFROM = $dateIntervals[4]["from"];
        $fridayFROM = Carbon::createFromFormat('Y-m-d', $fridayFROM)->format('d.m.Y');
        $fridayTO = $dateIntervals[4]["to"];
        $fridayTO = Carbon::createFromFormat('Y-m-d', $fridayTO)->format('d.m.Y');

        // dd($dayOfWeek);

        return View('index', ['activeVotingDay' => $dayOfWeek, 'mondayFrom' => $mondayFROM, 'tuesdayFrom' => $tuesdayFROM, 'wednesdayFrom' => $wednesdayFROM, 'thursdayFrom' => $thursdayFROM, 'fridayFrom' => $fridayFROM, 'mondayTo' => $mondayTO, 'tuesdayTo' => $tuesdayTO, 'wednesdayTo' => $wednesdayTO, 'thursdayTo' => $thursdayTO, 'fridayTo' => $fridayTO]);
    }
}
