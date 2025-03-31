<?php

namespace Database\Seeders;

use App\Models\Song;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('songs')->insert([
            'title' => 'Polska krava',
            'author' =>    'https://www.youtube.com/watch?v=8pIpi1HDEhU',
            'img_path' => './img/krava.jpg',
            'songId' => '1'
        ]);
        DB::table('songs')->insert([
            'title' => 'Madarska krava',
            'author' =>    'https://www.youtube.com/watch?v=CT7Ps71tY4A',
            'img_path' => './img/krava2.jpg',
            'songId' => '1'
        ]);
        DB::table('songs')->insert([
            'title' => 'Slovenska krava',
            'author' =>    'https://www.youtube.com/watch?v=O0Cg7bfPf6o',
            'img_path' => './img/krava3.jpg',
            'songId' => '1'
        ]);
        DB::table('songs')->insert([
            'title' => 'Ceska krava',
            'author' =>    'https://www.youtube.com/watch?v=H9OrNx7hnvs',
            'img_path' => './img/krava4.jpg',
            'songId' => '1'
        ]);
        DB::table('songs')->insert([
            'title' => 'Rakuska krava',
            'author' =>    'https://www.youtube.com/watch?v=nrLsT2kY0rE',
            'img_path' => './img/krava5.jpg',
            'songId' => '1'
        ]);
    }
}