@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">Search for "{{ Request::get('q') }}"</div>

					<div class="card-body">
						@if ($channels->count())
							<h4>Channels</h4>
							<div class="card bg-light card-body mb-3">
								@foreach($channels as $channel)
									<div class="media mb-2">
										<div class="media-left mr-2">
											<a href="/channel/{{ $channel->slug }}">
												<img src="{{ $channel->getImage() }}" alt="{{ $channel->name }} image" class="media-object">
											</a>
										</div>
										<div class="media-body">
											<a href="/channel/{{ $channel->slug }}" class="media-heading">{{ $channel->name }}</a>
											subscription count
										</div>
									</div>
								@endforeach
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
