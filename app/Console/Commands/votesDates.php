<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;

class votesDates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:votes-dates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $client = new Client();

        try {
            // Ensure the route helper function returns the correct URL
            $url = route('cronJOBvotesDATES.index');
            $this->info("Visiting URL: $url");

            $response = $client->get($url);

            if ($response->getStatusCode() === 200) {
                $this->info('Website visited successfully!');
            } else {
                $this->error('Failed to visit website. Status code: ' . $response->getStatusCode());
            }
        } catch (\Exception $e) {
            $this->error('An error occurred: ' . $e->getMessage());
        }
    }
}
