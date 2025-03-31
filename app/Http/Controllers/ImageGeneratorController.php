<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;



class ImageGeneratorController extends Controller
{
    public function index()
    {
        $data = Song::all();
        $manager = new ImageManager(
            new Intervention\Image\Drivers\Gd\Driver()
        );

        // open an image file
        $image = $manager->read('images/example.gif');

        // resize image instance
        $image->resize(height: 300);

        // insert a watermark
        $image->place('images/watermark.png');

        // encode edited image
        $encoded = $image->toJpg();

        // save encoded image
        $encoded->save('images/example.jpg');
    }
}
