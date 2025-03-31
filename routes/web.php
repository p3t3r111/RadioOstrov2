<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\cronJOBaddSONGS;
use App\Http\Controllers\cronJOBcreateVoteResultImg;
use App\Http\Controllers\cronJOBdownloadSongs;
use App\Http\Controllers\cronJOBvotedSONGSController;
use App\Http\Controllers\cronJOBvotesDATESController;
use App\Http\Controllers\cronJOBvotesSONGSController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageGeneratorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VoteController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\CheckIfAdmin;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;

Route::view('/ochrana-udajov', 'ochrana_udajov')->name('ochranaUdajov');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [HomeController::class, 'authCheck'])->name('index');
    // PROFILE_USER
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/songs', [ProfileController::class, 'songs'])->name('profile.songs');
    Route::patch('/profile/picture', [ProfileController::class, 'picture'])->name('profile.picture');

    // GAME
    Route::view('/game', 'game.index');

    // ADMIN
    Route::middleware(['isAdmin'])->group(function () {
        Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.index');

        Route::get('admin/confirming-songs', [AdminController::class, 'confirmSongsIndex'])->name('admin.confirming-songs');
        Route::post('admin/confirmUserSong', [AdminController::class, 'confirmUsersSongsPost'])->name('admin.confirmUsersSongsPost');

        Route::get('admin/authorized-songs', [AdminController::class, 'authorizedSongsIndex'])->name('admin.authorized-songs');
        
        Route::get('admin/denied-songs', [AdminController::class, 'deniedSongsIndex'])->name('admin.denied-songs');
        Route::get('admin/deny-song', [AdminController::class, 'denyUsersSongsPost'])->name('admin.denyUsersSongsPost');

        Route::get('admin/backup-songs', [AdminController::class, 'backupSongsIndex'])->name('admin.backup-songs');
        Route::post('admin/addSongs', [AdminController::class, 'addBackupSongsPost'])->name('admin.addBackSongsPost');
        Route::post('admin/delSongs', [AdminController::class, 'delBackupSongsPost'])->name('admin.delBackSongsPost');

        Route::get('admin/playSongs', [AdminController::class, 'playSongs'])->name('admin.playSongs');
        Route::get('admin/addSongs', [AdminController::class, 'addSongs'])->name('admin.addSongs');
    });

    // VOTE
    Route::get('votes', [VoteController::class, 'index'])->name('vote.index');
    Route::get('votes/history', [VoteController::class, 'history'])->name('vote.history');
    Route::get('vote', [VoteController::class, 'active'])->name('vote.active');
    Route::post('vote', [VoteController::class, 'vote'])->name('vote.vote');
});

Route::middleware('cron')->group(function () {
    Route::get('cronSONGS', [cronJOBvotesSONGSController::class, 'index'])->name('cronJOBvotesSONGS.index');
    Route::get('/queue-start', function () {
        Artisan::call('queue:restart');
        Artisan::call('queue:work');
    });
});
Route::get('cronDATES', [cronJOBvotesDATESController::class, 'index'])->name('cronJOBvotesDATES.index');
Route::get('cronVOTED', [cronJOBvotedSONGSController::class, 'index'])->name('cronJOBvotedSONGS.index');
Route::get('cronIMAGE', [ImageGeneratorController::class, 'index'])->name('cronImage.index');

Route::get('cronAddSONGS', [cronJOBaddSONGS::class, 'index'])->name('cronJOBaddSONGS.index');
Route::get('cronCreateImage', [cronJOBcreateVoteResultImg::class, 'index'])->name('cronJOBcreateImage.index');

Route::middleware(['auth','isAdmin'])->get('/spotify/search', function () {
    $token = cache()->remember('spotify_token', 3600, function () {
        $response = Http::asForm()->post('https://accounts.spotify.com/api/token', [
            'grant_type' => 'client_credentials',
            'client_id' => config('spotify.auth.client_id'),
            'client_secret' => config('spotify.auth.client_secret'),
        ]);

        return $response->json()['access_token'] ?? null;
    });

    $query = request('q');
    if (!$query) return response()->json(['tracks' => []]);

    $response = Http::withToken($token)->get('https://api.spotify.com/v1/search', [
        'q' => $query,
        'type' => 'track',
        'limit' => request('limit', 10),
    ]);

    return $response->json();
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

require __DIR__ . '/auth.php';