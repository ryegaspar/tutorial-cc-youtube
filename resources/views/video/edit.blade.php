@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">Edit Video "{{ $video->title }}"</div>

					<div class="card-body">
						<form action="/videos/{{ $video->uid }}" method="post">
							<div class="form-group row">
								<label for="title" class="col-md-2 col-form-label text-md-right">Title</label>

								<div class="col-md-10">
									<input id="title" type="text"
										   class="form-control @error('name') is-invalid @enderror"
										   name="title"
										   value="{{ old('title') ?: $video->title }}"
										   required
										   autocomplete="name"
										   autofocus>

									@error('title')
									<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
									@enderror
								</div>
							</div>

							<div class="form-group row">
								<label for="description"
									   class="col-md-2 col-form-label text-md-right">Description</label>

								<div class="col-md-10">
									<textarea id="description"
											  class="form-control"
											  name="description">
										{{ old('description') ?: $video->description }}
									</textarea>
								</div>
							</div>

							<div class="form-group row">
								<label for="visibility" class="col-md-2 col-form-label text-md-right">Visibility</label>

								<div class="col-md-10">
									<select name="visibility" id="visibility" class="form-control">
										@foreach(['public', 'unlisted', 'private'] as $visibility)
											<option
												value="{{ $visibility }}" {{ $video->visibility == $visibility ? 'selected="selected"' : '' }}>
												{{ ucfirst($visibility) }}
											</option>
										@endforeach
									</select>

									@error('visibility')
									<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
									@enderror
								</div>
							</div>

							<div class="form-group row">
								<label for="allow_votes" class="col-form-label col-md-2 text-md-right">Allow Votes
								</label>

								<div class="col-md-auto">
									<input type="checkbox"
										   name="allow_votes"
										   id="allow_votes"
										   class="form-control"
										{{ $video->votesAllowed() ? 'checked="checked"' : '' }}
									/>
								</div>
							</div>

							<div class="form-group row">
								<label for="allow_comments" class="col-form-label col-md-2 text-md-right">Allow Comments
								</label>

								<div class="col-md-auto">
									<input type="checkbox"
										   name="allow_comments"
										   id="allow_comments"
										   class="form-control"
										{{ $video->commentsAllowed() ? 'checked="checked"' : '' }}
									/>
								</div>
							</div>

							<button class="btn btn-primary" type="submit">Update</button>

							@csrf
							@method('put')
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
