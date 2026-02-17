<?php

use App\Http\Controllers\Cron\CronJobCreateVoteResultImg;
use App\Http\Controllers\Cron\CronJobGetHolidaysController;
use App\Http\Controllers\Cron\CronJobPauseSongsController;
use App\Http\Controllers\Cron\CronJobPlaySongsController;
use App\Http\Controllers\Cron\CronJobVotingDatesController;
use App\Http\Controllers\Cron\CronResetVotingController;
use Illuminate\Support\Facades\Route;

Route::middleware(app()->environment('production') ? 'cron' : null)->group(function () {
    Route::get('/queue-start', function () {
        Artisan::call('queue:restart');
        Artisan::call('queue:work', ['--stop-when-empty' => true, '--max-time' => 60]);
    });
    Route::get('cronDates', [CronJobVotingDatesController::class, 'index'])->name('cronJOBvotesDATES.index');

    Route::middleware('isHoliday')->group(function () {
        Route::get('cronResetVoting', [CronResetVotingController::class, 'index'])->name('cronJOBresetVoting.index');
        Route::get('cronPlaySongs', [CronJobPlaySongsController::class, 'index'])->name('cronJOBplaySongs.index');
        Route::get('cronPauseSongs', [CronJobPauseSongsController::class, 'index'])->name('cronJOBpauseSongs.index');

    });
});
Route::get('cronCreateImage', [CronJobCreateVoteResultImg::class, 'index'])->name('cronJOBcreateImage.index');
Route::get('cronGetHolidays', [CronJobGetHolidaysController::class, 'index'])->name('cronJOBgetHolidays.index');
