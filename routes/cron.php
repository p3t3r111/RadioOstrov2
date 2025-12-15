<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cron\CronJobVotedSongsController;
use App\Http\Controllers\Cron\CronJobVotingDatesController;
use App\Http\Controllers\Cron\CronJobVotingSongsController;

use App\Http\Controllers\Cron\CronJobAddSongsController;
use App\Http\Controllers\Cron\CronJobPlaySongsController;
use App\Http\Controllers\Cron\CronJobPauseSongsController;

use App\Http\Controllers\Cron\CronJobCreateVoteResultImg;
use App\Http\Controllers\Cron\CronJobImageGeneratorController;

Route::middleware('cron')->group(function () {
    Route::get('/queue-start', function () {
        Artisan::call('queue:restart');
        Artisan::call('queue:work');
    });
    
    Route::get('cronDATES', [CronJobVotingDatesController::class, 'index'])->name('cronJOBvotesDATES.index');
    Route::get('cronVOTED', [CronJobVotedSongsController::class, 'index'])->name('cronJOBvotedSONGS.index');
    Route::get('cronSONGS', [CronJobVotingSongsController::class, 'index'])->name('cronJOBvotesSONGS.index');
    
    Route::get('cronAddSONGS', [CronJobAddSongsController::class, 'index'])->name('cronJOBaddSONGS.index');
    Route::get('cronPlaySongs', [CronJobPlaySongsController::class, 'index'])->name('cronJOBplaySongs.index');
    Route::get('cronPauseSongs', [CronJobPauseSongsController::class, 'index'])->name('cronJOBpauseSongs.index');
    
});
Route::get('cronCreateImage', [CronJobCreateVoteResultImg::class, 'index'])->name('cronJOBcreateImage.index');