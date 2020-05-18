@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-body">
						<div class="media">
							<div class="media-left mr-3">
								<img src="{{ $channel->getImage() }}" alt="{{ $channel->name }} image"
									 class="media-object">
							</div>

							<div class="media-body">
								{{ $channel->name }}

								<ul class="list-inline">
									<li class="list-inline-item">
										<subscribe-button channel-slug="{{ $channel->slug }}"></subscribe-button>
									</li>

									<li class="list-inline-item">
										{{ $channel->totalVideoViews() }} video views
									</li>
								</ul>

								@if ($channel->description)
									<hr>
									<p>{{ $channel->description }}</p>
								@endif
							</div>
						</div>
					</div>
				</div>

				<div class="card">
					<div class="card-header">Dashboard</div>

					<div class="card-body">
						@if ($videos->count())
							@foreach($videos as $video)
								<div class="well">
									@include('video.partials._video_result', ['video' => $video])
								</div>
							@endforeach

							{{ $videos->links() }}
						@else
							<p>{{ $channel->name }} has no videos</p>
						@endif
					</div>
				</div>

			</div>
		</div>
	</div>
@endsection
