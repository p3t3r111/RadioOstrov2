<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VotingDatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('voting_dates')->insert([
            'from' => '2024-09-05',
            'to' => '2024-09-08'
        ]);
        DB::table('voting_dates')->insert([
            'from' => '2024-09-08',
            'to' => '2024-09-09'
        ]);
        DB::table('voting_dates')->insert([
            'from' => '2024-09-09',
            'to' => '2024-09-10'
        ]);
        DB::table('voting_dates')->insert([
            'from' => '2024-09-10',
            'to' => '2024-09-11'
        ]);
        DB::table('voting_dates')->insert([
            'from' => '2024-09-11',
            'to' => '2024-09-12'
        ]);
    }
}
