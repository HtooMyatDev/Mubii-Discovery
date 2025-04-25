@extends('admin.layouts.master')

@section('title')
    <link rel="stylesheet" href="{{ asset('admin/css/customize.css') }}">
    <title>
        Movie List Page
    </title>
@endsection

@section('content')
    <form action="{{ route('movie#add') }}" method="POST">
        @csrf
        <div class="row my-3">
            <div class="col">
                <label for="" class="text-secondary">Movie Name</label>
                <input type="text" value="{{ old('title') }}" class="form-control" placeholder="Enter the movie name..."
                    name="title">
                @if (session('Movie Status'))
                    <small class="text-danger">{{ session('Movie Status') }}</small>
                @endif
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col">
                <label for="" class="text-secondary">Trailer Link</label>
                <input type="text" value="{{ old('embed_link') }}" name="embed_link" class="form-control"
                    placeholder="Enter the trailer link...">
                @error('embed_link')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="row my-3">
            <div class="col">
                <button type="submit" class="btn btn-outline-primary">Add to list</button>
            </div>
        </div>
    </form>
    <div class="d-flex flex-row flex-wrap gap-5 ">
        @if (count($movies) > 0)
            @foreach ($movies as $movie)
                    <div class="d-flex flex-column">
                        <div class="row">
                            <a href="/admin/movie/edit/{{ $movie->id }}">
                                <div class="">
                                    <div class="card shadow-lg">
                                        <div class="card-inner">
                                            <div class="card-front">
                                                <img style="width: 225px; height: 310px;"
                                                    class="rounded border border-start-0 border-end-0"
                                                    src="{{ $movie->poster }}" alt="">
                                            </div>
                                            <div class="card-back d-flex flex-column text-center">
                                                <p class="my-2 d-flex flex-column"> <span class="fw-bold">Director </span>
                                                    {{ $movie->director_name }}</p>
                                                <p class="my-2 d-flex flex-column"> <span class="fw-bold">Writer </span>
                                                    {{ $movie->writer }}</p>
                                                <p class="my-2 d-flex flex-column"> <span class="fw-bold">Type </span>
                                                    {{ $movie->type }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="row">
                            <div class="col">
                                <a href="/admin/movie/edit/{{ $movie->id }}" class="w-100 btn btn-outline-primary">Edit</a>
                            </div>
                            <div class="col-4">
                                <a href="/admin/movie/delete/{{ $movie->id }}" class="w-100 btn btn-outline-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </div>
                        </div>
                    </div>
            @endforeach
        @else
            <div class="text-white w-100 fw-bold p-3 text-center h5 bg-danger">There is no movie in database!</div>
        @endif
    </div>



@endsection
