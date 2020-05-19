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
												<img src="{{ $channel->getImage() }}" alt="{{ $channel->name }} image"
													 class="media-object">
											</a>
										</div>
										<div class="media-body">
											<a href="/channel/{{ $channel->slug }}"
											   class="media-heading"
											>
												{{ $channel->name }}
											</a>
											<ul class="list-inline">
												<li>{{ $channel->subscriptionCount() }} subscribers</li>
											</ul>
										</div>
									</div>
								@endforeach
							</div>
						@endif

						<h4>Videos</h4>

						@if ($videos->count())
							@foreach($videos as $video)
								<div class="card card-body bg-light mb-3">
									@include('video.partials._video_result', ['video' => $video])
								</div>
							@endforeach
						@else
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
