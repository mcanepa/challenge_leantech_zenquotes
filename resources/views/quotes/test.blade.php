<x-app-layout>
	<ul>
		<li><p><a href="{{ route('api.quote.five') }}">REST API for Five Random Quotes</a></p></li>
		<li><p><a href="{{ route('api.quote.five-new') }}">REST API for Five Random Quotes (reload)</a></p></li>
		<li><p><a href="{{ route('api.quote.ten') }}">REST API for Ten Random Quotes</a></p></li>
		<li><p><a href="{{ route('api.quote.ten-new') }}">REST API for Ten Random Quotes (reload)</a></p></li>
	</ul>
</x-app-layout>
