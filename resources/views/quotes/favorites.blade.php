<x-app-layout>
	@if($quotes->count())
		<table>
			<thead>
				<tr>
					<th>Quote</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($quotes as $quote)
					@php
						$item = json_decode($quote["data"], true)
					@endphp
					<tr>
						<td>{{ $item["q"] }} </td>
						<td>
							<form action="{{ route('quote.favorite-remove') }}" method="post">
								@csrf
								<input type="hidden" name="quote" value="{{ $quote["id"] }}">
								<button type="submit" class="remove">Remove from favorites</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@else
		<p>Your list of favorites quotes is empty. Visit the <a href="{{ route('quote.today') }}">quote of the day</a> and add one!</p>
	@endif
</x-app-layout>
