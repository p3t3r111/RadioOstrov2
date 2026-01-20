<?php

namespace App\Http\Controllers;

use App\Models\Backup_song;
use App\Models\Song;
use App\Models\Vote;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spotify;

class AdminController extends Controller
{
    public function index()
    {
        $songsToConfirmInfo = null;
        $confirmedSongs = null;
        $deniedSongsInfo = null;
        $backupSongsInfo = null;

        $songsToConfirmInfo = Song::where('confirmed', 0)->count();
        $confirmedSongs = Song::where('confirmed', 1)->count();
        $deniedSongsInfo = Song::where('confirmed', -1)->count();
        $backupSongsInfo = Backup_song::count();

        return view('admin.dashboard', [
            'songsToConfirm' => $songsToConfirmInfo,
            'confirmedSongs' => $confirmedSongs,
            'deniedSongs' => $deniedSongsInfo,
            'backupSongs' => $backupSongsInfo,
        ]);
    }

    public function confirmSongsIndex()
    {
        $songInfo = [];
        $unconfirmedSongs = Song::where('confirmed', 0)->get();

        foreach ($unconfirmedSongs as $unconfirmedSong) {
            $songArray = [
                'songId' => $unconfirmedSong->songId,
                'imgPath' => $unconfirmedSong->img_path,
                'author' => $unconfirmedSong->author,
                'title' => $unconfirmedSong->title,
            ];
            if (! in_array($songArray, $songInfo)) {
                $songInfo[] = $songArray;
            }
        }

        $currentPage = Paginator::resolveCurrentPage();
        $perPage = 10;
        $currentItems = array_slice($songInfo, ($currentPage - 1) * $perPage, $perPage);
        $songInfo = new LengthAwarePaginator(
            $currentItems,
            count($songInfo),
            $perPage,
            $currentPage,
            ['path' => Paginator::resolveCurrentPath()]
        );

        return view('admin.subpages.confirming-songs', [
            'songInfo' => $songInfo,
        ]);
    }

    public function confirmUsersSongsPost(Request $request)
    {
        $song = Song::where('title', $request->song)->first();
        $song->confirmed = 1;
        $song->save();

        return redirect()->back();
    }

    public function authorizedSongsIndex()
    {
        $songInfo = [];
        $unconfirmedSongs = Song::where('confirmed', 1)->get();

        foreach ($unconfirmedSongs as $deniedSong) {
            $songArray = [
                'songId' => $deniedSong->songId,
                'imgPath' => $deniedSong->img_path,
                'author' => $deniedSong->author,
                'title' => $deniedSong->title,
            ];
            if (! in_array($songArray, $songInfo)) {
                $songInfo[] = $songArray;
            }
        }

        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems2 = array_slice($songInfo, ($currentPage - 1) * $perPage, $perPage);
        $songInfo = new LengthAwarePaginator($currentItems2, count($songInfo), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

        return view('admin.subpages.authorized-songs', [
            'songInfo' => $songInfo,
        ]);
    }

    public function deniedSongsIndex()
    {
        $songInfo = [];
        $deniedSongs = Song::where('confirmed', -1)->get();

        foreach ($deniedSongs as $deniedSong) {
            $songArray = [
                'songId' => $deniedSong->songId,
                'imgPath' => $deniedSong->img_path,
                'author' => $deniedSong->author,
                'title' => $deniedSong->title,
            ];
            if (! in_array($songArray, $songInfo)) {
                $songInfo[] = $songArray;
            }
        }

        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems2 = array_slice($songInfo, ($currentPage - 1) * $perPage, $perPage);
        $songInfo = new LengthAwarePaginator($currentItems2, count($songInfo), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

        return view('admin.subpages.denied-songs', [
            'songInfo' => $songInfo,
        ]);
    }

    public function denyUsersSongsPost(Request $request)
    {
        $song = Song::where('songId', $request->songId)->first();
        $song->confirmed = -1;
        $song->save();

        return redirect()->back();
    }

    public function backupSongsIndex()
    {
        $backupSongs = [];
        $songBackup = DB::table('backup_songs')->get();
        foreach ($songBackup as $song) {
            $songArray = [
                'songId' => $song->songId,
                'imgPath' => $song->imgPath,
                'author' => $song->author,
                'title' => $song->title,
                'user' => $song->user,
            ];
            if (! in_array($songArray, $backupSongs)) {
                array_push($backupSongs, $songArray);
            }
        }

        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems3 = array_slice($backupSongs, ($currentPage - 1) * $perPage, $perPage);
        $backupSongs = new LengthAwarePaginator($currentItems3, count($backupSongs), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

        return view('admin.subpages.backup-songs', [
            'backupSongs' => $backupSongs,
        ]);
    }

    public function addBackupSongsPost(Request $request)
    {
        $string_version = $request->songAddInput;

        // dd($string_version);
        $songInfo = [];

        if (! $string_version == null) {
            $json = Spotify::searchTracks($string_version)->limit(1)->get('tracks');
            $i = 0;
            if (isset($json['items']) && count($json['items']) > 0) {
                $song = [
                    'songId' => $json['items'][0]['id'],
                    'imgPath' => $json['items'][0]['album']['images'][1]['url'],
                    'author' => $json['items'][0]['artists'][0]['name'],
                    'title' => $json['items'][0]['name'],
                ];
                array_push($songInfo, $song);
                $i++;
            } else {
                array_push($songInfo, null);
            }
        } else {
            return redirect()->back();
        }

        // item['songId'] = songId
        // item['imgPath'] = thumbnail_url
        // item['author'] = author
        // item['title'] = title
        foreach ($songInfo as $item) {
            if (trim($item['songId']) !== 'empty') {
                $song = DB::table('backup_songs')->where('songId', trim($item['songId']))->first();
                if (! $song) {
                    DB::table('backup_songs')->insert([
                        'songId' => trim($item['songId']),
                        'imgPath' => trim($item['imgPath']),
                        'author' => trim($item['author']),
                        'title' => trim($item['title']),
                        'user' => trim(Auth::user()->name),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        return redirect()->back();
    }

    public function delBackupSongsPost(Request $request)
    {
        Backup_song::where('title', trim($request->song))->delete();

        return redirect()->back();
    }

    public function playSongs()
    {
        $timenow = Carbon::now()->format('Y-m-d');
        $i = 0;
        $items = [];
        $votes = Vote::select('songName', 'songId', DB::raw('count(*) as total'))->where('datum', $timenow)->groupBy('songName', 'songId')->orderBy('total', 'desc')->orderBy('songName')->take(5)->get();
        foreach ($votes as $vote) {
            if ($i < 5) {
                $item = [
                    'songId' => $vote->songId,
                    'title' => $vote->songName,
                    'totalVotes' => $vote->total,
                ];
                array_push($items, $item);
                $i++;
            }
        }

        return view('admin.playSongs', [
            'items' => $items,
        ]);
    }
}
