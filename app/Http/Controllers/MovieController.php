<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{

    public function getMovieData(Request $request)
    {
        $movies = $this->getMovies();
        $topMovies = $this->getTopMovies();

        if ($request->has('search')) {
            return $this->searchMovies($request);
        }

        return view('movies', compact('movies', 'topMovies'));
    }

    public function getMovies()
    {
        $apiKey = env('MOVIE_API_KEY');

        $headers = [
            'Authorization' => 'Bearer ' . $apiKey,
            'Accept' => 'application/json',
        ];

        $response = Http::withHeaders($headers)
            ->get('https://api.themoviedb.org/3/movie/popular?language=en-US&page=1');

        $movies = $response->json();

        return $movies;
    }

    public function getTopMovies()
    {
        $apiKey = env('MOVIE_API_KEY');

        $headers = [
            'Authorization' => 'Bearer ' . $apiKey,
            'Accept' => 'application/json',
        ];

        $response = Http::withHeaders($headers)
            ->get('https://api.themoviedb.org/3/movie/top_rated?language=en-US&page=1');

        $topMovies = $response->json();

        return $topMovies;
    }

    public function searchMovies(Request $request)
    {
        $apiKey = env('MOVIE_API_KEY');

        try {
            $searchTerm = $request->input('search');

            $headers = [
                'Authorization' => 'Bearer ' . $apiKey,
                'Accept' => 'application/json',
            ];

            $response = Http::withHeaders($headers)
                ->get("https://api.themoviedb.org/3/search/movie?query=$searchTerm&include_adult=false&language=en-US&page=1");

            if ($response->successful()) {
                $searchResults = $response->json();
                return view('movies', ['searchResults' => $searchResults]);
            } else {
                return view('movies', ['error' => 'Failed to retrieve search results']);
            }
        } catch (\Exception $e) {
            return view('movies', ['error' => $e->getMessage()]);
        }
    }
}