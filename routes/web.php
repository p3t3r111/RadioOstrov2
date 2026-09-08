<?php

use App\Actions\spotify\Connect;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::view('/ochrana-udajov', 'ochrana_udajov')->name('ochranaUdajov');

Route::get('/invite/{code}', [ReferralController::class, 'store'])
    ->name('referral');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');

    Route::get('/lang/{locale}', function ($locale) {

        if (auth()->check()) {
            auth()->user()->update([
                'locale' => $locale,
            ]);
        }
        session(['locale' => $locale]);
        app()->setLocale($locale);

        return back();
    })->name('lang.switch');

    // PROFILE_USER
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/songs', [ProfileController::class, 'songs'])->name('profile.songs');
    Route::patch('/profile/picture', [ProfileController::class, 'picture'])->name('profile.picture');
    Route::patch('/profile/theme', [ProfileController::class, 'patchTheme'])->name('profile.theme.update');
    Route::post('/rewards/claim/{reward}', [ProfileController::class, 'claimReward'])->name('rewards.claim');
    Route::post('/profile/update-referallink', [ProfileController::class, 'updateReferalLink'])->name('profile.update.referallink');

    // GAME
    Route::view('/game', 'game.index');

    // ADMIN
    Route::middleware(['isAdmin'])->group(function () {
        Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.index');

        Route::get('admin/confirming-songs', [AdminController::class, 'confirmSongsIndex'])->name('admin.confirming-songs');
        Route::post('admin/confirm-user-song', [AdminController::class, 'confirmUsersSongsPost'])->name('admin.confirmUsersSongsPost');

        Route::get('admin/authorized-songs', [AdminController::class, 'authorizedSongsIndex'])->name('admin.authorized-songs');

        Route::get('admin/denied-songs', [AdminController::class, 'deniedSongsIndex'])->name('admin.denied-songs');
        Route::post('admin/deny-song', [AdminController::class, 'denyUsersSongsPost'])->name('admin.denyUsersSongsPost');

        Route::get('admin/backup-songs', [AdminController::class, 'backupSongsIndex'])->name('admin.backup-songs');
        Route::post('admin/add-songs', [AdminController::class, 'addBackupSongsPost'])->name('admin.addBackSongsPost');
        Route::post('admin/del-songs', [AdminController::class, 'delBackupSongsPost'])->name('admin.delBackSongsPost');

        Route::get('admin/play-songs', [AdminController::class, 'playSongs'])->name('admin.playSongs');
        Route::get('admin/add-songs', [AdminController::class, 'addSongs'])->name('admin.addSongs');

        Route::get('admin/holidays', [AdminController::class, 'holidays'])->name('admin.holidays');
        Route::post('admin/holidays/add', [AdminController::class, 'addHolidayPost'])->name('admin.addHoliday');
        Route::post('admin/holidays/delete', [AdminController::class, 'deleteHoliday'])->name('admin.deleteHoliday');

        Route::get('admin/updates', [AdminController::class, 'updates'])->name('admin.updates');
        Route::post('admin/updates/add', [AdminController::class, 'addUpdatePost'])->name('admin.addUpdate');
        Route::post('admin/updates/delete', [AdminController::class, 'deleteUpdate'])->name('admin.deleteUpdate');

        Route::get('admin/pause-songs', [AdminController::class, 'pauseSongs'])->name('admin.pauseSongs');
    });

    // VOTE
    Route::get('votes', [VoteController::class, 'index'])->name('vote.index');
    Route::get('votes/history', [VoteController::class, 'history'])->name('vote.history');
    Route::get('vote', [VoteController::class, 'active'])->name('vote.active');
    Route::post('vote', [VoteController::class, 'vote'])->name('vote.vote')->middleware('throttle:5,1');
});

Route::middleware(['auth'])->get('/spotify/search', function () {
    $query = request('q');
    $api = Connect::execute();
    if (! $query) {
        return response()->json(['tracks' => []]);
    }
    $json = $api->search($query, ['track'], [
        'limit' => 10,
    ])->tracks;

    return $json;
});

Route::get('email', function () {
    return view('mail.verify_email');
});
Route::get('email2', function () {
    return view('mail.reset_password');
});
Route::get('test', function () {
    return view('test');
});

require __DIR__.'/auth.php';
require __DIR__.'/cron.php';
