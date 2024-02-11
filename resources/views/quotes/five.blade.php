<x-app-layout>
	<a href="{{ route('quote.five-new') }}"><button type="button">Get 5 new quotes</button></a>

	@foreach($data["quotes"] as $quote)
		@php
			$cache = $quote["cache"] ?? false;
			$quote = json_decode($quote["data"], true)
		@endphp

		<p>quote #{{ ($loop->index) + 1}}: @if($cache) [cached] @endif {{ $quote["q"] }}</p>
	@endforeach
</x-app-layout>
