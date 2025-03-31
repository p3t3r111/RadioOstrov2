<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http; // Použitie Laravel HTTP klienta
use Illuminate\Support\Facades\Log;  // Použitie Laravel log facady

class resetVoting extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset-voting';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $url = route('cronJOBvotesSONGS.index');
        Log::info("Visiting URL: $url");

        $response = Http::get($url);

        if ($response->successful()) {
            Log::info("Request successful: " . $response->body());
        } else {
            Log::error("Request failed with status: " . $response->status());
        }
    }
}
