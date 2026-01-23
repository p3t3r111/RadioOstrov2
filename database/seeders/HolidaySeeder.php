<?php

namespace Database\Seeders;

use App\Models\Holiday;
use Illuminate\Database\Seeder;

class HolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Holiday::create([
            'name' => 'Skrateny den',
            'start_date' => '2026-01-26',
            'end_date' => '2026-01-26',
            'type' => 'test',
        ]);
    }
}
