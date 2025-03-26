@extends('admin.layouts.master')

@section('title')
    <title>
        Movie List Page
    </title>
@endsection

@section('content')
    <form action="{{ route('movie#get') }}" method="POST">
        @csrf
        <div class="row my-3">
            <div class="col">
                <label for="" class="text-secondary">Movie Name</label>
                <input type="text" value="{{ old('movieName') }}" class="form-control" placeholder="Enter the movie name..."
                    name="movieName">
                @if (session('Movie Status'))
                    <small class="text-danger">{{ session('Movie Status') }}</small>
                @endif
                @error('movieName')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col">
                <label for="" class="text-secondary">Trailer Link</label>
                <input type="text" value="{{ old('trailerLink') }}" name="trailerLink" class="form-control"
                    placeholder="Enter the trailer link...">
                @error('trailerLink')
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
    <div class="row">
        @if (count($movies) > 0)
            @foreach ($movies as $movie)
                <div class="col-2">
                    <img style="width: 250px; height: 100%; object-fit: cover;" class="shadow-sm img-thumbnail"
                        src="{{ $movie->poster }}" alt="">
                </div>
            @endforeach
        @endif
    </div>
@endsection
