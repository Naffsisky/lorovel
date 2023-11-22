<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="{{ route('index') }}">
      <img src="{{ asset('images/logo/logo2.png') }}" class="logo" alt="Logo Baru">
      P r o t i v y
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('index') ? 'active' : '' }}" href="{{ route('index') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('weather') ? 'active' : '' }}" href="{{ route('weather') }}">Weather</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('movies') ? 'active' : '' }}" href="{{ route('movies') }}">Movies</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('foods') ? 'active' : '' }}" href="{{ route('foods') }}">Foods</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('notes') ? 'active' : '' }}" href="{{ route('notes') }}">Notes</a>
        </li>
      </ul>
    </div>
  </div>
</nav>