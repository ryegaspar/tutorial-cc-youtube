@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-10">
				video player
				<div class="card">
					<div class="card-body">
						<h4>{{ $video->title }}</h4>
						<div class="float-right">
							Video views
						</div>
						<div class="media">
							<div class="media-left">
								<a href="/channel/{{ $video->channel->slug }}">
									<img src="{{ $video->channel->getImage() }}"
										 alt="{{ $video->channel->name }} image">
								</a>
							</div>
							<div class="media-body">
								<a href="/channel/{{ $video->channel->slug }}"
								   class="ml-3">{{ $video->channel->name }}</a>
								Subscribe button
							</div>
						</div>
					</div>
				</div>

				<br/>

				@if ($video->description)
					<div class="card">
						<div class="card-body">
							{!! nl2br(e($video->description)) !!}
						</div>
					</div>
				@endif

				<br/>

				<div class="card">
					<div class="card-body">
						@if ($video->commentsAllowed())
							Comments
						@else
							<p>Comments are disabled</p>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
