<?php

namespace App\Http\Controllers\Cron;

use App\Http\Controllers\Controller;
use App\Models\active_voting_song;
use App\Models\Song;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spotify;

class CronJobVotingSongsController extends Controller
{
    public function index()
    {
        $voted = User::all()->where('voted', 1);
        foreach ($voted as $voted) {
            $voted->voted = 0;
            $voted->save();
        }
        $songs = 0;
        $songs = Song::where('confirmed', 1)->get();
        $songsCount = count($songs);
        if ($songsCount >= 0) {
            // user songs
            $songVotesList = [];
            $songIds = Song::where('confirmed', 1)->get('id');
            $songIdsArray = [];
            foreach ($songIds as $song) {
                array_push($songIdsArray, $song->id);
            }
            for ($i = 0; count($songVotesList) < 10; $i++) {
                $randomNumber = rand(1, count($songIdsArray)) - 1;
                $randomId = $songIdsArray[$randomNumber];
                $randomSong = Song::find($randomId);
                if (!in_array($randomSong, $songVotesList)) {
                    array_push($songVotesList, $randomSong);
                }
            }

            active_voting_song::truncate();

            $i = 0;
            foreach ($songVotesList as $item) {
                if (trim($item)) {
                    $song = active_voting_song::where('songId', trim($item->songId))->first();
                    if (!$song) {
                        $song = new active_voting_song();
                        $song->songId = trim($item->songId);
                        $song->imgPath = trim($item->img_path);
                        $song->author = trim($item->author);
                        $song->title = trim($item->title);
                        $song->save();
                    }
                    $i++;
                }
            }
        } else {
            active_voting_song::truncate();
            foreach ($songs as $song) {
                $json = Spotify::searchTracks($song)->limit(1)->get('tracks');
                $songArray2 = [
                    'songId' => $json['items'][0]['id'],
                    'imgPath' => $json['items'][0]['album']['images'][1]['url'],
                    'author' => $json['items'][0]['artists'][0]['name'],
                    'title' => $json['items'][0]['name'],
                ];

                // $songArray2['songId'] = songId
                // $songArray2['imgPath'] = thumbnail_url
                // $songArray2['author'] = author
                // $songArray2['title'] = title
                $songDB = DB::table('backup_songs')->where('songId', trim($songArray2['songId']))->first();
                if (!$songDB) {
                    $songDB = new active_voting_song();
                    $songDB->songId = trim($songArray2['songId']);
                    $songDB->imgPath = trim($songArray2['imgPath']);
                    $songDB->author = trim($songArray2['author']);
                    $songDB->title = trim($songArray2['title']);
                    $songDB->save();
                }
            }
        }

        dd('done');
    }
}