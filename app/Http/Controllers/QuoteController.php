<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuoteRequest;
use App\Http\Requests\UpdateQuoteRequest;
use App\Models\Quote;
use Illuminate\Support\Facades\Cache;

class QuoteController extends Controller
{
    private function getRandomQuote()
    {
        $data = Quote::inRandomOrder()->take(1)->get();

        return $data[0]->toArray();
    }

    public function today()
    {
        $data = [];

        if(Cache::has("today"))
        {
            $data["cache"] = true;

            $data["quotes"] = Cache::get("today");
        }
        else
        {
            $data["cache"] = false;

            $quote = $this->getRandomQuote();

            $data["quotes"] = $quote;

            Cache::put("today", $quote, intval(env("DEFAULT_CACHE_TTL")));
        }

        return view("quotes.today", compact("data"));
    }
}
