<?php

namespace App\Http\Controllers\Cron;

use App\Actions\cron\AddNewSongsToPlaylist;
use App\Actions\cron\GenerateNewVotingSongs;
use App\Actions\cron\StoreVotingSongs;
use App\Http\Controllers\Controller;
use App\Models\User;

class CronResetVotingController extends Controller
{
    public function index()
    {
        sleep(50);
        $votedUsers = User::where('voted', '>', 0)->each(function ($user) {
            $user->all_time_points += $user->voted * config('app.vote_point_value');
            $user->save();
        });
        StoreVotingSongs::execute();
        GenerateNewVotingSongs::execute();
        AddNewSongsToPlaylist::execute();
    }
}
