<x-app-layout>
	<a href="{{ route('quote.ten-new') }}"><button type="button">Get 10 new quotes</button></a>

	<table>
		<thead>
			<tr>
				<th>Quote</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data["quotes"] as $quote)
				@php
					$cache = $quote["cache"] ?? false;
					$quote_data = json_decode($quote["data"], true)
				@endphp

				<tr>
					<td>quote #{{ ($loop->index) + 1}}: @if($cache) [cached] @endif {{ $quote_data["q"] }} </td>
					<td>
						<form action="{{ route('quote.favorite-add') }}" method="post">
							@csrf
							<input type="hidden" name="quote" value="{{ $quote["id"] }}">
							<button type="submit" class="add">Add to favorites</button>
						</form>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
</x-app-layout>
