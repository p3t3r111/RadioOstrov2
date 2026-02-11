<?php

namespace App\Http\Controllers\Cron;

use App\Actions\PausePlaying;
use App\Http\Controllers\Controller;

class CronJobPauseSongsController extends Controller
{
    public function index()
    {
        PausePlaying::execute();

    }
}
