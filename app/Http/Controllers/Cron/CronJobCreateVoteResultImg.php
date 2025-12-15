<?php

namespace App\Http\Controllers\Cron;

use App\Http\Controllers\Controller;
use App\Models\Vote;
use DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CronJobCreateVoteResultImg extends Controller
{
    public function index()
    {
        $manager = new ImageManager(driver: new Driver());

        $img = $manager->read(file_get_contents(public_path('assets/instagram/bg.png')));

        // all vote song for current day
        $songs = Vote::select('songName','songAuthor','songImgPath', DB::raw('COUNT(*) - 1 as count'))->where('datum', '2025-12-12')->groupBy('songName','songAuthor','songImgPath')->orderByDesc('count')->limit(3)->get();

        foreach ($songs as $index => $song) {

            switch ($index) {
                case 0:
                    $x = 415;
                    $y = 50;
                    $boxColor = '#FFD700';
                    break;
                case 1:
                    $x = 750;
                    $y = 225;
                    $boxColor = '#C0C0C0';
                    break;
                case 2:
                    $x = 80;
                    $y = 225;
                    $boxColor = '#CD7F32';
                    break;
            }

            // song background box
            $box = $manager->create(width: 250, height: 300);
            $box->fill($boxColor);
            $img->place($box, 'top-left', $x, $y);

            // song image
            $imgData = file_get_contents($song->songImgPath);
            $songImg = $manager->read($imgData)->resize(150, 150);
            $img->place($songImg, 'top-left', $x + 50, $y + 20);

            // song name
            $img->text("{$song->songName}", $x + 10, $y + 200, function ($font) {
                $font->file(public_path('assets/fonts/Roboto.ttf'));
                $font->size(22);
                $font->color('#000000');
            });

            // song author
            $img->text("by {$song->songAuthor}", $x + 10, $y + 220, function ($font) {
                $font->file(public_path('assets/fonts/Roboto.ttf'));
                $font->size(18);
                $font->color('#777777');
            });

            // vote count
            $img->text("Votes: {$song->count}", $x + 10, $y + 260, function ($font) {
                $font->file(public_path('assets/fonts/Roboto.ttf'));
                $font->size(20);
                $font->color('#555555');
            });
        }

        $img->toPng()->save(public_path('assets/custom/foo.png'));
    }
}