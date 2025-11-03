<?php

namespace App\Http\Controllers;

use App\Models\active_voting_song;
use App\Models\Vote;
use App\Models\VotingDates;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CronJobVotedSongsController extends Controller
{
    public function index()
    {
        $song_query = active_voting_song::all();

        $dateNow = Carbon::now()->format('Y-m-d');
        $dateNowUNIX = strtotime($dateNow);
        $dateIntervals = VotingDates::all("from", "to")->toArray();
        foreach ($dateIntervals as $dateInterval) {
            $fromUNIX = $dateInterval["from"];
            $toUNIX = $dateInterval["to"];
            $fromUNIX = new DateTime($fromUNIX);
            $fromUNIX->setTime(config('app.voting_hours'), 0);
            $toUNIX = new DateTime($toUNIX);
            $toUNIX->setTime(config('app.voting_hours'), 0);
            $fromUNIX = strtotime($dateInterval["from"]);
            $toUNIX = strtotime($dateInterval["to"]);

            if ($dateNowUNIX >= $fromUNIX && $dateNowUNIX <= $toUNIX) {
                $votingDateUNIX = $toUNIX + 86400;
                $votingDateNEW = date("Y-m-d", $votingDateUNIX);
                break;
            }
        }
        foreach ($song_query as $song) {
            $userid = -3;
            $username = "bot";
            $songid = $song->songId;
            $songtitle = $song->title;
            $songauthor = $song->author;
            $songimgpath = $song->imgPath;
            $vote = new Vote();
            $vote->datum = $votingDateNEW;
            $vote->users_id = $userid;
            $vote->username = $username;
            $vote->songs_id = $songid;
            $vote->songName = $songtitle;
            $vote->songauthor = $songauthor;
            $vote->songimgpath = $songimgpath;
            $vote->save();
        }
        echo "done";
    }
}