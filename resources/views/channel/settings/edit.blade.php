@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Channel Settings</div>

                    <div class="card-body">
                        <form action="/channel/{{ $channel->slug }}/edit" method="post" enctype="multipart/form-data">

                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">Name</label>

                                <div class="col-md-10">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') ?: $channel->name }}" required autocomplete="name"
                                           autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="slug" class="col-md-2 col-form-label text-md-right">Unique URL</label>

                                <div class="col-md-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">{{ env('APP_URL')}}/channel/</span>
                                        </div>
                                        <input id="slug" type="text"
                                               class="form-control @error('slug') is-invalid @enderror" name="slug"
                                               value="{{ old('slug') ?: $channel->slug }}" required autocomplete="slug"
                                               autofocus>
                                        @error('slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description"
                                       class="col-md-2 col-form-label text-md-right">Description</label>

                                <div class="col-md-10">
                                    <textarea name="description" id="description"
                                              class="form-control">{{ old('description') ?: $channel->description }}</textarea>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="image"
                                       class="col-md-2 col-form-label text-md-right">Channel Image</label>

                                <div class="col-md-10">
                                    <input id="image"
                                           type="file"
                                           class="form-control"
                                           name="image">
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
