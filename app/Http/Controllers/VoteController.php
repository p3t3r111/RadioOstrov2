<?php

namespace App\Http\Controllers;

use App\Models\active_voting_song;
use App\Models\User;
use App\Models\Vote;
use App\Models\VotingDates;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class VoteController extends Controller
{
    public function index()
    {
        $hlasyNEW = [];
        $i = 0;
        $hlasy = Vote::distinct()->orderBy('datum', 'desc')->pluck('datum');
        $timestampNow = Carbon::now()->timestamp;
        foreach ($hlasy as $item) {
            $date = Carbon::createFromFormat('Y-m-d H:i:s', $item . ' ' . config("app.voting_time_full"));
            $timestamp = $date->subDay()->timestamp;
            if ($timestamp < $timestampNow) {
                $datum = Carbon::createFromFormat('Y-m-d', $item)->format('d.m.Y');
                $datumArr = [
                    'datum' => $datum,
                    'active' => false
                ];
                array_push($hlasyNEW, $datumArr);
            }
        }

        $dateIntervals = VotingDates::all("from", "to")->toArray();
        foreach ($dateIntervals as $dateInterval) {
            $fromDate = Carbon::createFromFormat('Y-m-d', $dateInterval['from'])
                ->setTime(config('app.voting_hours'), 0, 0);
            $toDate = Carbon::createFromFormat('Y-m-d', $dateInterval['to'])
                ->setTime(config('app.voting_hours'), 0, 0);

            $fromUNIX = $fromDate->timestamp;
            $toUNIX = $toDate->timestamp;

            if ($timestampNow >= $fromUNIX && $timestampNow <= $toUNIX) {
                $i = 1;
                $votingDateUNIX = $toDate->addDay()->timestamp;
                $datum = Carbon::createFromTimestamp($votingDateUNIX)->format('d.m.Y');
                $datumArr = [
                    'datum' => $datum,
                    'active' => true
                ];
                array_unshift($hlasyNEW, $datumArr);
                break;
            }
        }


        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems2 = array_slice($hlasyNEW, ($currentPage - 1) * $perPage, $perPage);
        $hlasyNEW = new LengthAwarePaginator($currentItems2, count($hlasyNEW), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

        return view('votes', ['hlasy' => $hlasyNEW]);
    }

    public function history(Request $request)
    {
        $date = $request->query('date');
        if ($date) {
            $datum2 = Carbon::createFromFormat('d.m.Y', $date);
            $date2 = strtotime($date);
            $date_db = date("Y-m-d", $date2);
            $db_query = Vote::select('songId', 'songName', 'songAuthor', 'songImgPath', DB::raw('count(id) as voteCount'))
                ->where('datum', $date_db)
                ->groupBy('songId', 'songName', 'songAuthor', 'songImgPath')
                ->orderBy('voteCount', 'desc')
                ->orderBy('songName')
                ->get();

            $nazov_dna = $datum2->format('l');

            switch ($nazov_dna) {
                case "Monday":
                    $nazov_dna = "Pondelok";
                    break;
                case "Tuesday":
                    $nazov_dna = "Utorok";
                    break;
                case "Wednesday":
                    $nazov_dna = "Streda";
                    break;
                case "Thursday":
                    $nazov_dna = "Štvrtok";
                    break;
                case "Friday":
                    $nazov_dna = "Piatok";
                    break;
            }
            return view('vote.historyVote', ['datum' => $date, 'den' => $nazov_dna, 'result' => $db_query]);
        } else {
            return abort(404);
        }
    }

    public function active()
    {
        if (Auth::user()->voted == 0) {
            $dateNowUNIX = Carbon::now()->timestamp;
            $dateIntervals = VotingDates::all("from", "to")->toArray();
            foreach ($dateIntervals as $dateInterval) {
                $fromDate = Carbon::createFromFormat('Y-m-d', $dateInterval['from'])
                    ->setTime(config('app.voting_hours'), 0, 0);
                $toDate = Carbon::createFromFormat('Y-m-d', $dateInterval['to'])
                    ->setTime(config('app.voting_hours'), 0, 0);

                $fromUNIX = $fromDate->timestamp;
                $toUNIX = $toDate->timestamp;

                if ($dateNowUNIX >= $fromUNIX && $dateNowUNIX <= $toUNIX) {

                    $votingDateUNIX = $toDate->addDay()->timestamp;
                    $votingDateNEW = date("d.m.Y", $votingDateUNIX);

                    $datum2 = Carbon::createFromFormat('d.m.Y', $votingDateNEW);
                    $nazov_dna = $datum2->format('l');

                    switch ($nazov_dna) {
                        case "Monday":
                            $nazov_dna = "Pondelok";
                            break;
                        case "Tuesday":
                            $nazov_dna = "Utorok";
                            break;
                        case "Wednesday":
                            $nazov_dna = "Streda";
                            break;
                        case "Thursday":
                            $nazov_dna = "Štvrtok";
                            break;
                        case "Friday":
                            $nazov_dna = "Piatok";
                            break;
                    }

                    $songsArray = [];
                    $songs = active_voting_song::all();
                    foreach ($songs as $song) {
                        $songArray = [
                            "title" => $song->title,
                            "author" => $song->author,
                            "imgPath" => $song->imgPath,
                            "songId" => $song->songId
                        ];
                        array_push($songsArray, $songArray);
                    }

                    if (count($songsArray) < 5) {
                        return view("vote.noActiveVote");
                    }

                    return view(
                        "vote.activeVote",
                        [
                            "den" => $nazov_dna,
                            "datum" => $votingDateNEW,
                            "songs" => $songsArray
                        ],
                    );
                }
            }
        } else {
            return view("vote.voted");
        }
        return view("vote.noActiveVote");
    }

    public function vote(Request $request)
    {
        $request->validate([
            'selected_song' => 'required'
        ]);

        $song_query = active_voting_song::where('id', $request->selected_song + 1)->first();
        $userid = Auth::user()->id;
        $username = Auth::user()->name;
        $songid = $song_query->songId;
        $songName = $song_query->title;
        $songAuthor = $song_query->author;
        $songImgPath = $song_query->imgPath;
        $date = date('Y-m-d', strtotime($request->date));
        $vote = new Vote();
        $vote->datum = $date;
        $vote->users_id = $userid;
        $vote->username = $username;
        $vote->songName = $songName;
        $vote->songId = $songid;
        $vote->songAuthor = $songAuthor;
        $vote->songImgPath = $songImgPath;
        $vote->save();
        $user = User::find($userid);
        $user->voted = 1;
        $user->save();

        return redirect()->route('vote.active');
    }
}