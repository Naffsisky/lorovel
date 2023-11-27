@extends('layouts.master') @section('css')
<link rel="stylesheet" href="{{ asset('css/movie.css') }}" />
@endsection @section('content')
<main>
<div class="search-container">
    <form action="{{ url('/movies') }}" method="GET" class="search-form">
        <label for="search" class="label">Search Your Favorite Movie or TV Show 📺</label>
        <div class="input-group">
            <input
                type="text"
                name="search"
                class="search-input animated-border"
                placeholder="Enter keywords..."
            />
            <div class="button-group">
                <button type="submit" class="btn btn-dark">Search</button>
                <a class="btn btn-danger" href="{{ url('/movies') }}">Reset</a>
            </div>
        </div>
    </form>
</div>
<div class="sub-heading">
    <ul>
        <li><a href="{{ url('/movies') }}#topmovies">Top Movies</a></li>
        <li><a href="{{ url('/movies') }}#toprated">Top Rated</a></li>
    </ul>
</div>
    <h1 class="my-4">SEARCH RESULT</h1>
    @if(isset($searchResults) && count($searchResults['results']) > 0)
    <div class="row">
        @foreach($searchResults['results'] as $result)
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <img
                    src="{{ 'https://image.tmdb.org/t/p/w500' . $result['poster_path'] }}"
                    class="card-img-top"
                    alt="{{ $result['title'] }}"
                />
                <div class="card-body">
                    <h5 class="card-title">{{ $result['title'] }}</h5>
                    <p class="card-text">
                        {{ \Illuminate\Support\Str::limit($result['overview'],
                        50, $end='...') }}
                    </p>
                </div>
                <div class="card-footer">
                    <small class="text-muted"><b>Release Date</b></small>
                    <br />
                    <small class="text-muted"
                        >{{ $result['release_date'] }}</small
                    >
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <p style="text-align: center">No movies found.</p>
    @endif @if(!isset($searchResults) || count($searchResults['results']) == 0)
    <h1 class="my-4" id="topmovies">TOP MOVIES 🎬</h1>
    <div class="row">
        @if(isset($movies) && count($movies['results']) > 0)
        @foreach($movies['results'] as $movie)
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <img
                    src="{{ 'https://image.tmdb.org/t/p/w500' . $movie['poster_path'] }}"
                    class="card-img-top"
                    alt="{{ $movie['title'] }}"
                />
                <div class="card-body">
                    <h6 class="card-title">{{ $movie['title'] }}</h6>
                </div>
                <div class="card-footer card-desc">
                    <p><b>Description</b></p>
                    <p class="card-text">
                        {{ \Illuminate\Support\Str::limit($movie['overview'],
                        50, $end='...') }}
                    </p>
                </div>
                <div class="card-footer">
                    <small class="text-muted"><b>Release Date</b></small>
                    <br />
                    <small class="text-muted"
                        >{{ $movie['release_date'] }}</small
                    >
                </div>
            </div>
        </div>
        @endforeach @else
        <p style="text-align: center">No movies found.</p>
        @endif
    </div>
    @endif @if(!isset($searchResults) || count($searchResults['results']) == 0)
    <h1 class="my-4" id="toprated">TOP RATED 🔥</h1>
    <div class="row">
        @if(isset($topMovies) && count($topMovies['results']) > 0)
        @foreach($topMovies['results'] as $movie)
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <div class="card h-100">
                    <img
                        src="{{ 'https://image.tmdb.org/t/p/w500' . $movie['poster_path'] }}"
                        class="card-img-top"
                        alt="{{ $movie['title'] }}"
                    />
                    <div class="card-body">
                        <h6 class="card-title">{{ $movie['title'] }}</h6>
                    </div>
                    <div class="card-footer card-desc">
                        <p><b>Description</b></p>
                        <p class="card-text">
                            {{ \Illuminate\Support\Str::limit($movie['overview'],
                            50, $end='...') }}
                        </p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted"><b>Release Date</b></small>
                        <br />
                        <small class="text-muted"
                            >{{ $movie['release_date'] }}</small
                        >
                    </div>
                </div>
            </div>
        </div>
        @endforeach @else
        <p style="text-align: center">No movies found.</p>
        @endif
    </div>
    @endif
</main>
@endsection @section('script')
<script src="{{ asset('js/movie.js') }}"></script>
@endsection
