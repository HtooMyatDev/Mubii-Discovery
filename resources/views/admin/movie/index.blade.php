@extends('admin.layouts.master')

@section('title')
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
    <div class="d-flex gap-3">
        @if (count($movies) > 0)
            @foreach ($movies as $movie)
                <div class="">
                    <div class="card shadow-lg">
                        <div class="card-inner">
                            <div class="card-front"> <img style="object-fit: cover;"
                                    class="img-thumbnail" src="{{ $movie->poster }}" alt=""></div>
                            <div class="card-back">Back Side</div>
                        </div>
                    </div>

                </div>
            @endforeach
        @else
            <div class="text-white fw-bold p-3 text-center h5 bg-danger">There is no movie in database!</div>
        @endif
    </div>



@endsection
