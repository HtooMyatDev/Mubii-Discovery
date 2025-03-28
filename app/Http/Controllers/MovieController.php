<?php
namespace App\Http\Controllers;

use App\Models\Cast;
use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Trailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::select("movies.id", "movies.poster", "directors.name as director_name", "movies.type", 'movies.writer')
            ->leftJoin("directors", "directors.id", "=", "movies.director_id")
            ->get();

        return view('admin.movie.index', compact('movies'));
    }
    public function addMovie(Request $request)
    {
        $this->checkValidation($request);
        $movie = $this->getMovieData($request);
        $data  = $this->getallData($movie, $request);
        if (! empty($movie->totalSeasons)) {
            $data['total_seasons'] = $movie->totalSeasons;
        } else {
            $data['total_seasons'] = 0;
        }

        Movie::updateOrCreate([
            'title' => $movie->Title,
        ], $data);

        return back();
    }

    public function editPage($id)
    {
        $data = Movie::select('trailers.embed_link', 'movies.title', 'movies.id as movie_id', 'trailers.id as trailer_id')
            ->where('movies.id', $id)
            ->leftJoin('trailers', 'trailers.id', '=', 'movies.trailer_id')
            ->first();

        return view('admin.movie.edit', compact('data'));
    }

    public function edit(Request $request)
    {
        $this->checkValidation($request);

        Movie::where('id', "=", $request->movie_id)->update([
            'title' => $request->title,
        ]);

        Trailer::where('id', $request->trailer_id)->update([
            'embed_link' => $request->embed_link,
        ]);

        return to_route('movie#list');
    }
    public function delete($id)
    {
        $movie = Movie::select('director_id', 'cast_id', 'genre_id', 'trailer_id')
            ->where('id', $id)
            ->first();

        Director::where('id', $movie->director_id)->delete();
        Cast::where('id', $movie->cast_id)->delete();
        Genre::where('id', $movie->genre_id)->delete();
        Trailer::where('id', $movie->trailer_id)->delete();
        Movie::where('id', $id)->delete();

        return to_route('movie#list');
    }
    private function checkValidation($request)
    {
        $validationRules = [
            'title'      => 'required',
            'embed_link' => "required",
        ];

        $request->validate($validationRules);
    }

    private function getMovieData($request)
    {
        $name     = str_replace(" ", "+", $request->title);
        $apikey   = '881fe2b3';
        $response = Http::get('https://www.omdbapi.com/?apikey=' . $apikey . '&t=' . $name . '&plot=full');
        return $response->object();
    }

    private function getAllData($movie, $request)
    {
        if ($movie->Response == 'False') {
            return back()->with('Movie Status', "Please check the movie name again!");
        }
        // $movie    = json_decode($response, true); # Json Format
        // $movie    = $response->object(); # Collection Format

        $genre = Genre::create([
            'genre' => $movie->Genre,
        ]);

        $cast = Cast::create([
            'name' => $movie->Actors,
        ]);

        $director = Director::create([
            'name' => $movie->Director,
        ]);

        $trailer = Trailer::create([
            'embed_link' => $request->embed_link,
        ]);

        return [
            'plot'              => $movie->Plot,
            'poster'            => $movie->Poster,
            'runtime'           => $movie->Runtime,
            'director_id'       => $director->id,
            'writer'            => $movie->Writer,
            'cast_id'           => $cast->id,
            'genre_id'          => $genre->id,
            'trailer_id'        => $trailer->id,
            'type'              => $movie->Type,
            'languages'         => $movie->Language,
            'country_of_origin' => $movie->Country,
            'released_date'     => $movie->Released,
        ];
    }
}
