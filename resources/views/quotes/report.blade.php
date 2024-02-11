<x-app-layout>
	<table class="report">
		<thead>
			<tr>
				<th>User</th>
				<th>Quote</th>
			</tr>
		</thead>
		<tbody>
			@foreach($users as $user)
				@php
					$quotes = $user->quotes
				@endphp
				<tr>
					<td><a href="#">{{ $user->name }}</a></td>
					<td>
						@foreach($quotes as $quote)
							@php
								$quote_data = json_decode($quote["data"], true)
							@endphp

							<h1>{{ $quote_data["q"] }}</h1>
							@if(Auth::user()->id == $user->id)
								<form action="{{ route('quote.favorite-remove') }}" method="post">
									@csrf
									<input type="hidden" name="quote" value="{{ $quote["id"] }}">
									<button type="submit" class="remove">Remove from favorites</button>
								</form>
							@endif
						@endforeach
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
</x-app-layout>
