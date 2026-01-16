<?php

use App\Http\Controllers\Cron\CronJobAddSongsController;
use App\Http\Controllers\Cron\CronJobCreateVoteResultImg;
use App\Http\Controllers\Cron\CronJobPauseSongsController;
use App\Http\Controllers\Cron\CronJobPlaySongsController;
use App\Http\Controllers\Cron\CronJobVotedSongsController;
use App\Http\Controllers\Cron\CronJobVotingDatesController;
use App\Http\Controllers\Cron\CronJobVotingSongsController;
use Illuminate\Support\Facades\Route;

Route::middleware('cron')->group(function () {
    Route::get('/queue-start', function () {
        Artisan::call('queue:restart');
        Artisan::call('queue:work');
    });

    Route::get('cronDATES', [CronJobVotingDatesController::class, 'index'])->name('cronJOBvotesDATES.index');
    Route::get('cronSONGS', [CronJobVotingSongsController::class, 'index'])->name('cronJOBvotesSONGS.index');

    Route::middleware('isHoliday')->group(function () {
        Route::get('cronVOTED', [CronJobVotedSongsController::class, 'index'])->name('cronJOBvotedSONGS.index');

        Route::get('cronPlaySongs', [CronJobPlaySongsController::class, 'index'])->name('cronJOBplaySongs.index');
        Route::get('cronPauseSongs', [CronJobPauseSongsController::class, 'index'])->name('cronJOBpauseSongs.index');

    });
});
Route::get('cronAddSONGS', [CronJobAddSongsController::class, 'index'])->name('cronJOBaddSONGS.index');
Route::get('cronCreateImage', [CronJobCreateVoteResultImg::class, 'index'])->name('cronJOBcreateImage.index');
Route::get('cronGetHolidays', [App\Http\Controllers\Cron\CronJobGetHolidaysController::class, 'index'])->name('cronJOBgetHolidays.index');
