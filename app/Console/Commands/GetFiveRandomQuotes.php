<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;

class GetFiveRandomQuotes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Get-FiveRandomQuotes {--new : Force reload}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Five Random Quotes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $new = "";

        if($this->option('new'))
        {
            $new = "/new";
        }

        // Instantiate Guzzle HTTP client
        $client = new Client();

        // Make a GET request to the endpoint
        $response = $client->get('http://127.0.0.1:8000/api/quotes' . $new);

        // Get the JSON response body
        $jsonResponse = $response->getBody()->getContents();

        // Decode JSON response
        $data = json_decode($jsonResponse, true);

        // Proper attribution
        $attribution = 'Inspirational quotes provided by <a href="https://zenquotes.io/" target="_blank">ZenQuotes API</a>';

        // Output the JSON response
        $this->info(json_encode($data, JSON_PRETTY_PRINT) . $attribution);
    }
}
