<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;


Schedule::command('app:cron-job-votes-dates')->timezone('CEST')->weeklyOn(4, config('app.voting_time'));
Schedule::command('app:cron-job-reset-voting')->timezone('CEST')->dailyAt(config('app.voting_time'));
Schedule::command('app:cron-job-voted-songs')->timezone('CEST')->dailyAt(config('app.voting_time'));
Schedule::command('app:cron-job-voted-songs')->timezone('CEST')->dailyAt(config('app.voting_time'));