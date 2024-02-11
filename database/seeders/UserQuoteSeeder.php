<?php

namespace Database\Seeders;

use App\Models\Quote;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserQuoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $quotes = Quote::all();

        foreach($users as $user)
        {
            // Shuffle the quotes to get random ones and pick three
            $randomQuotes = $quotes->shuffle()->take(3);

            // Attach the picked quotes to the user
            $user->quotes()->attach($randomQuotes);
        }
    }
}
