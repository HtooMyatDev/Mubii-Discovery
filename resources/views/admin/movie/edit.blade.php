@extends('admin.layouts.master')

@section('title')
    <title>Movie Information Edit</title>
@endsection

@section('content')
    <a href="{{ route('movie#list') }}" class="btn btn-outline-primary mb-2"> <i class="fa-solid fa-list"></i> Back to
        list</a>
    <form action="{{ route('movie#edit') }}" method="post">
        @csrf
        <input type="hidden" name="movie_id" value="{{ $data->movie_id }}">
        <input type="hidden" name="trailer_id" value="{{ $data->trailer_id }}">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-5">
                        <iframe width="560" height="315" id="change" src="{{ $data->embed_link }}"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                    <div class="col">
                        <div class="row my-2">
                            <div class="col-8 d-flex flex-column">
                                <label for="" class="text-secondary">Title</label>
                                <input type="text" class="p-2" name="title"
                                    value="{{ old('title', $data->title) }}">

                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row my-4">
                            <div class="col-8 d-flex flex-column">
                                <label for="" class="text-secondary">Embed Link</label>
                                <input type="text" onchange="changeIframe(this.value)" class="p-2" name="embed_link"
                                    value="{{ old('embed_link', $data->embed_link) }}">
                                @error('embed_link')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-8">
                                <button type="submit" class="btn btn-outline-primary">Change</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
