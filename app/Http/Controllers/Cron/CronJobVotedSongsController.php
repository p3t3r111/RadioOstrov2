<?php

namespace App\Http\Controllers\Cron;

use App\Http\Controllers\Controller;
use App\Models\Active_voting_song;
use App\Models\Vote;
use App\Models\VotingDates;
use Carbon\Carbon;
use DateTime;

class CronJobVotedSongsController extends Controller
{
    public function index()
    {
        $song_query = Active_voting_song::all();

        $dateNow = Carbon::now()->format('Y-m-d');
        $dateNowUNIX = strtotime($dateNow);
        $dateIntervals = VotingDates::all('from', 'to')->toArray();
        foreach ($dateIntervals as $dateInterval) {
            $fromUNIX = $dateInterval['from'];
            $toUNIX = $dateInterval['to'];
            $fromUNIX = new DateTime($fromUNIX);
            $fromUNIX->setTime(config('app.voting_hours'), 0);
            $toUNIX = new DateTime($toUNIX);
            $toUNIX->setTime(config('app.voting_hours'), 0);
            $fromUNIX = strtotime($dateInterval['from']);
            $toUNIX = strtotime($dateInterval['to']);

            if ($dateNowUNIX >= $fromUNIX && $dateNowUNIX <= $toUNIX) {
                $votingDateUNIX = $toUNIX + 86400;
                $votingDateNEW = date('Y-m-d', $votingDateUNIX);
                break;
            }
        }
        foreach ($song_query as $song) {
            $userid = -3;
            $username = 'bot';
            $songid = $song->songId;
            $songtitle = $song->title;
            $songAuthor = $song->author;
            $songImgPath = $song->imgPath;
            $vote = new Vote;
            $vote->datum = $votingDateNEW;
            $vote->users_id = $userid;
            $vote->username = $username;
            $vote->songId = $songid;
            $vote->songName = $songtitle;
            $vote->songAuthor = $songAuthor;
            $vote->songImgPath = $songImgPath;
            $vote->save();
        }
        echo 'done';
    }
}
