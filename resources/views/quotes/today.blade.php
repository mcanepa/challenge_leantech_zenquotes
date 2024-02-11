@php
$quote = json_decode($data["quotes"]["data"], true)
@endphp

<h1>@if($data["cache"]) [cache] @endif{{ $quote["q"] }}</h1>
