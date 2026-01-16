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
            'name' => 'Vianočné prázdniny',
            'start_date' => '2026-01-14',
            'end_date' => '2026-01-18',
            'type' => 'test',
        ]);
    }
}
