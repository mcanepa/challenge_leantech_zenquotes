<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuoteRequest;
use App\Http\Requests\UpdateQuoteRequest;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function new()
    {
        Cache::forget("today"); //clear cache

        return $this->today(); //get a new quote
    }

    //add selected quote to list for current user
    public function favorite_add(Request $request)
    {
        $user = Auth::user();

        if($user)
        {
            $user->quotes()->sync($request["quote"], false);
        }

        return redirect()->route("quote.favorite-quotes");
    }

    //remove selected quote from list for current user
    public function favorite_remove(Request $request)
    {
        $user = Auth::user();

        if($user)
        {
            $user->quotes()->detach($request["quote"]);
        }

        return redirect()->route("quote.favorite-quotes");
    }

    //get list of favorites for current user
    public function favorite_quotes()
    {
        $user = Auth::user();

        $quotes = $user->quotes()->get();

        return view("quotes.favorites", compact("quotes"));
    }
}
