<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class cronJOBcreateVoteResultImg extends Controller
{
    public function index()
    {
        $image1 = public_path('assets/logo.png');
        $img = Image::make($image1);
        $img->resize(300, 300);
        $img->save(public_path('assets/output.png'));
        dd("Obrázok bol upravený a uložený.");
    }
}
