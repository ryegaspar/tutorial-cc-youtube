@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-10">

				@if ($video->isPrivate() && Auth::check() && $video->ownedByUser(Auth::user()))
					<div class="alert alert-info">
						Your video is currently private. Only you can see it.
					</div>
				@endif

				@if ($video->isProcessed() && $video->canBeAccessed(Auth::user()))
					<video-player video-uid="{{ $video->uid }}"
								  video-url="{{ $video->getStreamUrl() }}"
								  thumbnail-url="{{ $video->getThumbnail() }}">
					</video-player>
				@endif

				@if (!$video->isProcessed())
					<div class="video-placeholder">
						<div class="video-placeholder__header">
							This video is processing.  Comeback a bit later.
						</div>
					</div>
				@elseif(!$video->canBeAccessed(Auth::user()))
					<div class="video-placeholder">
						<div class="video-placeholder__header">
							This video is private.
						</div>
					</div>
				@endif

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