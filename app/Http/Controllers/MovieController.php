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
        // Lakukan operasi lain jika diperlukan

        return view('movies', compact('movies', 'topMovies'));
    }

    public function getMovies()
    {
        $headers = [
            'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIyM2E1ZGU4NWVjOThlZWFjZjFkODY4Yjc5OWJiODEyYyIsInN1YiI6IjY1NWNmNmRkMDgxNmM3MDBmZDMzZDE0NyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.Tir2HVRaAema28B9Bpl1NUneeWxMRkgKspT4W7k9Tq8',
            'Accept' => 'application/json',
        ];

        $response = Http::withHeaders($headers)
            ->get('https://api.themoviedb.org/3/movie/popular?language=en-US&page=1');

        // Ambil data hasil dari response
        $movies = $response->json();

        // Kirim data hasil ke tampilan
        return $movies;
    }

    public function getTopMovies()
    {
        $headers = [
            'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIyM2E1ZGU4NWVjOThlZWFjZjFkODY4Yjc5OWJiODEyYyIsInN1YiI6IjY1NWNmNmRkMDgxNmM3MDBmZDMzZDE0NyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.Tir2HVRaAema28B9Bpl1NUneeWxMRkgKspT4W7k9Tq8',
            'Accept' => 'application/json',
        ];

        $response = Http::withHeaders($headers)
            ->get('https://api.themoviedb.org/3/movie/top_rated?language=en-US&page=1');

        // Ambil data hasil dari response
        $topMovies = $response->json();

        // Kirim data hasil ke tampilan
        return $topMovies;
    }

    public function searchMovies(Request $request)
    {
        try {
            $searchTerm = $request->input('search');

            $headers = [
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIyM2E1ZGU4NWVjOThlZWFjZjFkODY4Yjc5OWJiODEyYyIsInN1YiI6IjY1NWNmNmRkMDgxNmM3MDBmZDMzZDE0NyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.Tir2HVRaAema28B9Bpl1NUneeWxMRkgKspT4W7k9Tq8',
                'Accept' => 'application/json',
            ];

            $response = Http::withHeaders($headers)
                ->get("https://api.themoviedb.org/3/search/movie?query=$searchTerm&include_adult=false&language=en-US&page=1");

            // Check if the request was successful (status code 2xx)
            if ($response->successful()) {
                $searchResults = $response->json();
                return view('movies', ['searchResults' => $searchResults]);
            } else {
                // Log or handle the error
                return view('movies', ['error' => 'Failed to retrieve search results']);
            }
        } catch (\Exception $e) {
            // Log or handle the exception
            return view('movies', ['error' => $e->getMessage()]);
        }
    }
}