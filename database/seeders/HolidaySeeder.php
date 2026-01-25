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
            'start_date' => '2026-01-23',
            'end_date' => '2026-01-25',
            'type' => 'test',
        ]);
    }
}
