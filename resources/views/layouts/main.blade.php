<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'MovieVault')</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- MovieVault Noir Theme --}}
    <link href="{{ asset('css/movievault-noir.css') }}" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg navbar-dark mv-navbar sticky-top">
    <div class="container">
        <a class="navbar-brand mv-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
            <span class="mv-pill">MV</span>
            <span>MovieVault</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mvNav"
                aria-controls="mvNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="mvNav" class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto gap-lg-2 mt-3 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('movies.index') }}">Movies</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('categories.index') }}">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}">About</a>
                </li>
            </ul>

            <div class="d-flex gap-2 ms-lg-3 mt-3 mt-lg-0">
                <a class="btn mv-btn-ghost btn-sm" href="{{ route('categories.create') }}">
                    New Category
                </a>
                <a class="btn btn-sm mv-btn-primary" href="{{ route('movies.create') }}">
                    New Movie
                </a>
            </div>
        </div>
    </div>
</nav>

<main class="mv-shell flex-grow-1">
    @yield('content')
</main>

<footer class="mv-footer mt-auto">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-start gap-2">
        <div>
            <div class="fw-semibold">MovieVault</div>
        </div>

        <div class="small d-flex gap-2">
            <span class="mv-pill">OMDb</span>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
