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
use Str;

class VoteController extends Controller
{
    public function index()
    {
        $activeVotingTo = Carbon::parse(
            Voting_dates::activeVotingDate()->to
        )->setTime(config('app.voting_hours'), 0, 0);

        $hlasy = Vote::distinct()->orderBy('datum', 'desc')->pluck('datum')->map(function ($date) use ($activeVotingTo) {
            $votingDate = Carbon::createFromFormat('Y-m-d', $date)->setTime(config('app.voting_hours'), 0, 0);

            return [
                'datum' => $votingDate->format('d.m.Y'),
                'active' => $activeVotingTo->lt($votingDate),
            ];
        })->toArray();

        $activeVotingDay = $activeVotingTo->addDay()->format('d.m.Y');
        if (! in_array($activeVotingDay, array_column($hlasy, 'datum'))) {
            array_unshift($hlasy, ['datum' => $activeVotingDay, 'active' => true]);
        }

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
            $db_query = Song::withTotalWeightForDate($date_db)
                ->having('total_weight', '>', 0)
                ->orderByTotalWeight()
                ->get();

            if ($db_query->isEmpty()) {
                return abort(404);
            }

            $nazov_dna = Str::lower($datum2->format('l'));

            return view('vote.historyVote', ['datum' => $date, 'den' => $nazov_dna, 'result' => $db_query]);
        } else {
            return abort(404);
        }
    }

    public function active()
    {
        if (CheckHolidays::execute(now()->toDateString())) {
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
            $nazov_dna = Str::lower($votingDate->format('l'));

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

            $finalTotalVotes = $user->activeVotedSongs()->sum('vote_count');

            if ($finalTotalVotes > $user->max_votes_per_day) {
                abort(403, 'Too many votes');
            }
        });

        return view('vote.voted');
    }
}
