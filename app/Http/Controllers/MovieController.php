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
        $movies = Movie::get();
        return view('admin.movie.index', compact('movies'));
    }
    public function addMovie(Request $request)
    {
        $this->checkValidation($request);
        $movie = $this->getMovieData($request);
        $data  = $this->getallData($movie, $request);
        if (!empty($movie->totalSeasons)) {
            $data['total_seasons'] = $movie->totalSeasons;
        } else {
            $data['total_seasons'] = 0;
        }

        Movie::updateOrCreate([
            'title' => $movie->Title,
        ], $data);

        return back();
    }

    private function checkValidation($request)
    {
        $validationRules = [
            'movieName'   => 'required',
            'trailerLink' => "required",
        ];

        $request->validate($validationRules);
    }

    private function getMovieData($request)
    {
        $name     = str_replace(" ", "+", $request->movieName);
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
            'embed_link' => $request->trailerLink,
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
