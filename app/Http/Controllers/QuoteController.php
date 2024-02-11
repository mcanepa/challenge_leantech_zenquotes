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
    //Get random quotes
    private function getRandomQuotes($quantity)
    {
        $data = Quote::inRandomOrder()->take($quantity)->get();

        return $data->toArray();
    }

    public function today()
    {
        $data = [];

        if(Cache::has("today"))
        {
            $data["quotes"] = Cache::get("today");

            foreach($data["quotes"] as $key => $value)
            {
                $data["quotes"][$key]["cache"] = true;
            }
        }
        else
        {
            $quote = $this->getRandomQuotes(1);

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

    //get 5 random quotes
    public function five()
    {
        $data = [];

        if(Cache::has("five"))
        {
            $data["quotes"] = Cache::get("five");

            foreach($data["quotes"] as $key => $value)
            {
                $data["quotes"][$key]["cache"] = true;
            }
        }
        else
        {
            $quotes = $this->getRandomQuotes(5);

            $data["quotes"] = $quotes;

            Cache::put("five", $quotes, intval(env("DEFAULT_CACHE_TTL")));

        }

        return view("quotes.five", compact("data"));
    }

    //get 5 new random quotes
    public function five_new()
    {
        Cache::forget("five"); //clear cache

        return $this->five(); //get 5 new quotes
    }

    //get 10 random quotes
    public function ten()
    {
        $data = [];

        if(Cache::has("ten"))
        {
            $data["quotes"] = Cache::get("ten");

            foreach($data["quotes"] as $key => $value)
            {
                $data["quotes"][$key]["cache"] = true;
            }
        }
        else
        {
            $quotes = $this->getRandomQuotes(10);

            $data["quotes"] = $quotes;

            Cache::put("ten", $quotes, intval(env("DEFAULT_CACHE_TTL")));
        }

        return view("quotes.ten", compact("data"));
    }

    //get 10 new random quotes
    public function ten_new()
    {
        Cache::forget("ten"); //clear cache

        return $this->ten(); //get 10 new quotes
    }
}
