<?php

namespace App\Http\Controllers;

use App\Actions\CheckHolidays;
use App\Models\Active_voting_song;
use App\Models\Song;
use App\Models\Vote;
use App\Models\Voting_dates;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function index()
    {
        $hlasyNEW = [];
        $i = 0;
        $hlasy = Vote::distinct()->orderBy('datum', 'desc')->pluck('datum');
        $timestampNow = Carbon::now()->timestamp;
        foreach ($hlasy as $item) {
            $date = Carbon::createFromFormat('Y-m-d H:i:s', $item.' '.config('app.voting_time_full'));
            $timestamp = $date->subDay()->timestamp;
            if ($timestamp < $timestampNow) {
                $datum = Carbon::createFromFormat('Y-m-d', $item)->format('d.m.Y');
                $datumArr = [
                    'datum' => $datum,
                    'active' => false,
                ];
                array_push($hlasyNEW, $datumArr);
            }
        }

        $dateIntervals = Voting_dates::all('from', 'to')->toArray();
        foreach ($dateIntervals as $dateInterval) {
            $fromDate = Carbon::createFromFormat('Y-m-d', $dateInterval['from'])
                ->setTime(config('app.voting_hours'), 0, 0);
            $toDate = Carbon::createFromFormat('Y-m-d', $dateInterval['to'])
                ->setTime(config('app.voting_hours'), 0, 0);

            $fromUNIX = $fromDate->timestamp;
            $toUNIX = $toDate->timestamp;

            if ($timestampNow >= $fromUNIX && $timestampNow <= $toUNIX && Auth::user()->canVote()) {
                $i = 1;
                $votingDateUNIX = $toDate->addDay()->timestamp;
                $datum = Carbon::createFromTimestamp($votingDateUNIX)->format('d.m.Y');
                $datumArr = [
                    'datum' => $datum,
                    'active' => true,
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
            $date_db = date('Y-m-d', $date2);
            $db_query = Song::withCount([
                'votes as voteCount' => fn ($q) => $q->whereDate('datum', $date_db),
            ])
                ->having('voteCount', '>', 0)
                ->orderByDesc('voteCount')
                ->get();

            if ($db_query->isEmpty()) {
                return abort(404);
            }

            $nazov_dna = $datum2->format('l');

            switch ($nazov_dna) {
                case 'Monday':
                    $nazov_dna = 'Pondelok';
                    break;
                case 'Tuesday':
                    $nazov_dna = 'Utorok';
                    break;
                case 'Wednesday':
                    $nazov_dna = 'Streda';
                    break;
                case 'Thursday':
                    $nazov_dna = 'Štvrtok';
                    break;
                case 'Friday':
                    $nazov_dna = 'Piatok';
                    break;
            }

            return view('vote.historyVote', ['datum' => $date, 'den' => $nazov_dna, 'result' => $db_query]);
        } else {
            return abort(404);
        }
    }

    public function active()
    {
        if (CheckHolidays::execute()) {
            return view('vote.noActiveVote');
        }

        $user = Auth::user();
        $votes = $user->activeVotedSongs()
            ->pluck('vote_count', 'song_id')
            ->toArray();

        $dateNowUNIX = Carbon::now()->timestamp;
        $dateIntervals = Voting_dates::all('from', 'to')->toArray();
        foreach ($dateIntervals as $dateInterval) {
            $fromDate = Carbon::createFromFormat('Y-m-d', $dateInterval['from'])
                ->setTime(config('app.voting_hours'), 0, 0);
            $toDate = Carbon::createFromFormat('Y-m-d', $dateInterval['to'])
                ->setTime(config('app.voting_hours'), 0, 0);

            $fromUNIX = $fromDate->timestamp;
            $toUNIX = $toDate->timestamp;

            if ($dateNowUNIX >= $fromUNIX && $dateNowUNIX <= $toUNIX) {

                $votingDateUNIX = $toDate->addDay()->timestamp;
                $votingDateNEW = date('d.m.Y', $votingDateUNIX);

                $datum2 = Carbon::createFromFormat('d.m.Y', $votingDateNEW);
                $nazov_dna = $datum2->format('l');

                switch ($nazov_dna) {
                    case 'Monday':
                        $nazov_dna = 'Pondelok';
                        break;
                    case 'Tuesday':
                        $nazov_dna = 'Utorok';
                        break;
                    case 'Wednesday':
                        $nazov_dna = 'Streda';
                        break;
                    case 'Thursday':
                        $nazov_dna = 'Štvrtok';
                        break;
                    case 'Friday':
                        $nazov_dna = 'Piatok';
                        break;
                }

                $songsArray = [];
                $songs = Active_voting_song::with('song')->get();
                foreach ($songs as $song) {
                    if (isset($votes[$song->song->id])) {
                        $song->user_votes = $votes[$song->song->id];
                    } else {
                        $song->user_votes = null;
                    }
                    $songArray = [
                        'id' => $song->song->id,
                        'songId' => $song->song->songId,
                        'user_votes' => $song->user_votes,
                    ];
                    array_push($songsArray, $songArray);
                }

                if (count($songsArray) < 5) {
                    return view('vote.noActiveVote');
                }

                return view(
                    'vote.activeVote',
                    [
                        'den' => $nazov_dna,
                        'datum' => $votingDateNEW,
                        'songs' => $songsArray,
                        'maxVotes' => $user->max_votes_per_day,
                        'voteWeight' => $user->vote_weight,
                        'voteCounterUserTotal' => array_sum($votes),
                    ],
                );
            }
        }

        return view('vote.noActiveVote');
    }

    public function vote(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'date' => 'required|date',
            'votes' => 'required|array',
            'votes.*' => 'integer|min:0',
        ]);

        // dd($request->votes);

        $totalVotes = array_sum($request->votes);

        if ($totalVotes > $user->max_votes_per_day) {
            abort(403, 'Too many votes');
        }

        $date = date('Y-m-d', strtotime($request->date));
        $activeSongs = Active_voting_song::pluck('song_id')->flip();

        DB::transaction(function () use ($request, $user, $date, $activeSongs) {
            foreach ($request->votes as $songId => $voteCount) {
                if (! isset($activeSongs[$songId])) {
                    continue;
                }

                $voteCount = intval($voteCount);

                $vote = Vote::where([
                    'user_id' => $user->id,
                    'song_id' => $songId,
                    'datum' => $date,
                ])->lockForUpdate()->first();

                if ($vote && $voteCount === 0) {
                    $user->unMarkVoted($vote->vote_count);
                    $vote->delete();

                    continue;
                }

                if (! $vote && $voteCount > 0) {
                    $vote = Vote::create([
                        'datum' => $date,
                        'user_id' => $user->id,
                        'song_id' => $songId,
                        'vote_weight' => $user->vote_weight,
                        'vote_count' => $voteCount,
                    ]);

                    $user->markVoted($voteCount);

                    continue;
                }

                if ($vote && $voteCount !== $vote->vote_count) {

                    $diff = $voteCount - $vote->vote_count;

                    if ($diff > 0) {
                        $user->markVoted($diff);
                    } else {
                        $user->unMarkVoted(abs($diff));
                    }

                    $vote->update(['vote_count' => $voteCount]);
                }
            }
        });

        return view('vote.voted');
    }
}
