<!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent position-fixed w-100">
        <div class="container">
          <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('assets/img/logo.png') }}" alt="" width="30">
            RumahKost
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item mx-2">
                <a class="nav-link {{ Request::is('/') ? 'active fw-bold' : '' }}" href="{{ url('/') }}">BERANDA</a>
              </li>
              <li class="nav-item mx-2">
                <a class="nav-link {{ Request::is('pencarian') ? 'active fw-bold' : '' }}" href="{{ url('/pencarian') }}">PENCARIAN</a>
              </li>
            </ul>
        <div class="ms-auto">
            <a href="{{ route('register') }}" class="button-primary">Daftar</a>
            <a href="{{ route('login') }}" class="button-secundary">Masuk</a>
        </div>

          </div>
        </div>
      </nav>