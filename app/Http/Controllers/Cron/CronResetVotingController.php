<?php

namespace App\Http\Controllers\Cron;

use App\Actions\cron\AddNewSongsToPlaylist;
use App\Actions\cron\GenerateNewVotingSongs;
use App\Actions\cron\StoreVotingSongs;
use App\Http\Controllers\Controller;

class CronResetVotingController extends Controller
{
    public function index()
    {
        sleep(50);

        StoreVotingSongs::execute();
        GenerateNewVotingSongs::execute();
        AddNewSongsToPlaylist::execute();
    }
}
