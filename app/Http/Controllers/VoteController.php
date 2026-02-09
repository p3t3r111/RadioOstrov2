<?php

namespace App\Http\Controllers;

use App\Actions\CheckHolidays;
use App\Models\Active_voting_song;
use App\Models\Song;
use App\Models\User;
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
        $activeVotingTo = Carbon::parse(
            Voting_dates::activeVotingDate()->to
        )->setTime(config('app.voting_hours'), 0, 0);

        $hlasy = Vote::distinct()->orderBy('datum', 'desc')->pluck('datum')->map(function ($date) use ($activeVotingTo) {
            $votingDate = Carbon::parse($date)->setTime(config('app.voting_hours'), 0, 0);

            return [
                'datum' => $votingDate->format('d.m.Y'),
                'active' => $activeVotingTo->lt($votingDate),
            ];
        })->toArray();

        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems2 = array_slice($hlasy, ($currentPage - 1) * $perPage, $perPage);
        $hlasyNew = new LengthAwarePaginator($currentItems2, count($hlasy), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

        return view('votes', ['hlasy' => $hlasyNew]);
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

        $activeVotingDate = Voting_dates::activeVotingDate();
        if ($activeVotingDate) {
            $votingDate = Carbon::createFromFormat('Y-m-d', $activeVotingDate->to)
                ->setTime(config('app.voting_hours'), 0, 0)->addDay();
            $nazov_dna = $votingDate->format('l');

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
                    'datum' => $votingDate->format('d.m.Y'),
                    'songs' => $songsArray,
                    'maxVotes' => $user->max_votes_per_day,
                    'voteWeight' => $user->vote_weight,
                    'voteCounterUserTotal' => array_sum($votes),
                ],
            );
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

        $date = date('Y-m-d', strtotime($request->date));
        $activeSongs = Active_voting_song::pluck('song_id')->flip();

        DB::transaction(function () use ($request, $user, $date, $activeSongs) {
            $user = User::where('id', $user->id)
                ->lockForUpdate()
                ->first();

            $currentVotes = $user->activeVotedSongs()
                ->sum('vote_count');
            $incommingVotes = array_sum($request->votes);

            if ($currentVotes + $incommingVotes > $user->max_votes_per_day) {
                abort(403, 'Too many votes');
            }

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
