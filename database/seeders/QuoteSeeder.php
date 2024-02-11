<?php

namespace Database\Seeders;

use App\Models\Quote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Get quotes from external API
        $quotes = json_decode(file_get_contents("https://zenquotes.io/api/quotes"), true);

        foreach($quotes as $quote)
        {
            //Content from ARRAY to JSON
            $data = json_encode($quote);

            //We don't get an ID, so hash the content to somehow identify unique quote
            $hash = sha1($data);

            //Save the quote
            Quote::create([
                "hash" => $hash,
                "data" => $data,
            ]);
        }
    }
}
