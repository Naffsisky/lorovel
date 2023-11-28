@extends('layouts.master') @section('css')
<link rel="stylesheet" href="{{ asset('css/food.css') }}" />
@endsection @section('content')
<main>
    <h1>Foods and Beverages 🍟</h1>

    <div class="container-lg my-3">
        <div id="image" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active c-item" class="img-fluid">
                    <img
                        src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        class="d-block w-100 c-img"
                        alt="Slide 1"
                    />
                </div>
                <div class="carousel-item c-item" class="img-fluid">
                    <img
                        src="https://images.unsplash.com/photo-1606787366850-de6330128bfc?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        class="d-block w-100 c-img"
                        alt="Slide 2"
                    />
                </div>
                <div class="carousel-item c-item" class="img-fluid">
                    <img
                        src="https://images.unsplash.com/photo-1498837167922-ddd27525d352?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        class="d-block w-100 c-img"
                        alt="Slide 3"
                    />
                </div>
            </div>
            <a class="carousel-control-prev" href="#image" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#image" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>

    <form action="{{ url('/foods') }}" method="GET">
        <label for="search" class="label">You want to search some food?</label>
        <br />
        <input
            type="text"
            id="search"
            name="search"
            class="search-input"
            required
        />
        <button type="submit" class="btn btn-warning">Search</button>
    </form>

    

    @if(isset($searchResults))
    <h2>Search Results 🍔</h2>
    <div class="row">
        @foreach($searchResults as $result)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img
                    src="{{ $result['strMealThumb'] }}"
                    class="card-img-top"
                    alt="{{ $result['strMeal'] }}"
                />
                <div class="card-body">
                    <h5 class="card-title">{{ $result['strMeal'] }}</h5>
                    <p class="card-text">
                        {{
                        \Illuminate\Support\Str::limit($result['strInstructions'],
                        180, $end='...') }}
                    </p>
                    <div class="btn-right">
                        <a
                            href="{{ $result['strYoutube'] }}"
                            class="btn btn-danger"
                            target="_blank"
                            >Tutorial</a
                        >
                        <a
                            href="{{ $result['strSource'] }}"
                            class="btn btn-warning"
                            target="_blank"
                            >Recipes</a
                        >
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <h2>No results found 🥲</h2>
    @endif
</main>
@endsection @section('script')
<script src="{{ asset('js/food.js') }}"></script>
@endsection
