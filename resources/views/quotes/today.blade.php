<x-app-layout>
	@php
	$quote = json_decode($data["quotes"]["data"], true)
	@endphp

	<a href="{{ route('quote.new') }}"><button type="button">Get a new quote</button></a>

	<h1>@if($data["cache"]) [cache] @endif{{ $quote["q"] }}</h1>

	<form action="{{ route('quote.favorite-add') }}" method="post">
		@csrf
		<input type="hidden" name="quote" value="{{ $data["quotes"]["id"] }}">
		<button type="submit" class="add">Add to favorites</button>
	</form>

	<img src="https://zenquotes.io/api/image" alt="">
</x-app-layout>
