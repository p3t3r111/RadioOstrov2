<?php

namespace Database\Seeders;

use App\Models\Reward;
use Illuminate\Database\Seeder;

class RewardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Reward::create([
            'name' => 'Vote Count',
            'max_level' => 10,
            'points' => [3],
            'reward' => [1],
        ]);

        Reward::create([
            'name' => 'Vote Weight',
            'max_level' => 10,
            'points' => [5],
            'reward' => [0.5],
        ]);

        Reward::create([
            'name' => 'Favorite Song Count',
            'max_level' => 10,
            'points' => [2],
            'reward' => [1],
        ]);

        Reward::create([
            'name' => 'Custom Referral Link',
            'max_level' => 1,
            'points' => [10],
            'reward' => [1],
        ]);
    }
}
