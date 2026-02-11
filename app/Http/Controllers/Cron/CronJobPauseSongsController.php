<?php

namespace App\Http\Controllers\Cron;

use App\Actions\spotify\PausePlaying;
use App\Http\Controllers\Controller;

class CronJobPauseSongsController extends Controller
{
    public function index()
    {
        PausePlaying::execute();

    }
}
