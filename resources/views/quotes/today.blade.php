@php
$quote = json_decode($data["quotes"]["data"], true)
@endphp

<a href="{{ route('quote.new') }}"><button type="button">Get a new quote</button></a>
<h1>@if($data["cache"]) [cache] @endif{{ $quote["q"] }}</h1>

<img src="https://zenquotes.io/api/image">
