<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Song;
use App\Models\User;
use Carbon\CarbonInterval;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Spotify;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function show(Request $request): View
    {
        $user = User::with('songs.votes')->find(Auth::user()->id);

        $userSongs = $user->songs;
        $userSongsCount = $userSongs->count();
        if ($userSongsCount < $user->max_favorite_songs) {
            for ($i = $userSongsCount; $i < $user->max_favorite_songs; $i++) {
                $arrayPush = [
                    'songId' => null,
                    'title' => null,
                    'confirmed' => null,
                ];
                $userSongs->push($arrayPush);
            }
        }

        return view('profile.show', [
            'user' => $request->user(),
            'songs' => $userSongs,
            'votes' => $user->votes,
            'invited_people' => $user->invited_people,
            'max_votes_per_day' => $user->max_votes_per_day,
            'weight_per_vote' => $user->vote_weight,
            'max_favorite_songs' => $user->max_favorite_songs,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.show')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // $request->validateWithBag('userDeletion', [
        //     'password' => ['required', 'current_password'],
        // ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function songs(Request $request)
    {
        $songList = [];
        for ($i = 1; $i <= 5; $i++) {
            $song = 'song'.$i;
            $songId = 'song'.$i.'Id';
            $songF = [
                'songName' => $request->$song,
                'songId' => $request->$songId,
            ];
            array_push($songList, $songF);
        }

        $songInfo = [];

        foreach ($songList as $song) {
            // PRÍPAD MAZANIA PESNOČKY
            if (empty($song['songName'])) {
                array_push($songInfo, null);
            }

            // 1. MáME  ID PESNIČKY
            if (! empty($song['songId'])) {
                $json = Spotify::track($song['songId'])->get();
                if (isset($json) && count($json) > 0) {
                    $songToArr = [
                        'songId' => $json['id'],
                        'imgPath' => $json['album']['images'][1]['url'],
                        'author' => $json['artists'][0]['name'],
                        'title' => $json['name'],
                        'explicit' => $json['explicit'],
                        'duration_ms' => $json['duration_ms'],
                    ];
                    array_push($songInfo, $songToArr);
                } else {
                    array_push($songInfo, null);
                }

                continue;
            }

            // 2. MÁME NAZOV PESNIČKY
            if (! empty($song['songName'])) {
                $json = Spotify::searchTracks($song['songName'])->limit(1)->get('tracks');
                if (isset($json['items']) && count($json['items']) > 0) {
                    $song = [
                        'songId' => $json['items'][0]['id'],
                        'imgPath' => $json['items'][0]['album']['images'][1]['url'],
                        'author' => $json['items'][0]['artists'][0]['name'],
                        'title' => $json['items'][0]['name'],
                        'explicit' => $json['items'][0]['explicit'],
                        'duration_ms' => $json['items'][0]['duration_ms'],
                    ];
                    array_push($songInfo, $song);
                } else {
                    array_push($songInfo, null);
                }
            }
        }
        // dump($songInfo);1
        // dd("Stop");

        // item['songId'] = songId
        // item['imgPath'] = thumbnail_url
        // item['author'] = author
        // item['title'] = title
        // item['duration_ms'] = duration in milliseconds
        $songList = [];

        $user = User::with('songs')->find(Auth::user()->id);
        $songs = $user->songs;

        foreach ($songInfo as $index => $item) {
            $songToUpdate = $songs->get($index);
            if ($item) {
                // Nájdeme existujúcu skladbu alebo vytvoríme novú
                $existingSong = Song::where('title', $item['title'])->where('author', $item['author'])->where('songId', $item['songId'])->first();
                if (! $existingSong) {
                    $existingSong = Song::create([
                        'songId' => $item['songId'],
                        'author' => $item['author'],
                        'title' => $item['title'],
                        'img_path' => $item['imgPath'],
                        'duration_ms' => $item['duration_ms'] ?? 0,
                    ]);
                    if (! $item['explicit'] and CarbonInterval::milliseconds($item['duration_ms'])->cascade()->totalMinutes < 6) {
                        $existingSong->confirmed = 1;
                        $existingSong->save();
                    } else {
                        $existingSong->confirmed = -1;
                        $existingSong->save();
                    }
                }

                if ($songToUpdate) {
                    $user->songs()->wherePivot('id', $songToUpdate->pivot->id)->detach();
                }

                $user->songs()->syncWithoutDetaching([$existingSong->id]);
            } else {
                if ($songToUpdate) {
                    $user->songs()->wherePivot('id', $songToUpdate->pivot->id)->detach();
                }
            }
        }

        // dd('Stop');

        return Redirect::route('profile.show')
            ->with('status', 'songs-updated');
    }
}
