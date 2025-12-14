@extends('layouts.main')

@section('title', 'Home')

@section('content')
<div class="container py-4">
    <div class="p-4 p-md-5 mb-4 rounded bg-light">
        <div class="col-lg-8 px-0">
            <h1 class="display-6">MovieVault</h1>
            <p class="lead my-3">
                A personal movie catalogue where you can organise films into categories and add reviews.
            </p>
            <div class="d-flex gap-2">
                <a class="btn btn-primary" href="{{ route('movies.index') }}">Browse Movies</a>
                <a class="btn btn-outline-secondary" href="{{ route('categories.index') }}">Browse Categories</a>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Categories</h5>
                    <p class="card-text mb-0">Group movies by genre/category and keep your catalogue structured.</p>
                </div>
                <div class="card-footer bg-transparent">
                    <a href="{{ route('categories.create') }}" class="btn btn-sm btn-outline-primary">Add Category</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Movies</h5>
                    <p class="card-text mb-0">Add movies, automatically validate via OMDb, and track when you watched them.</p>
                </div>
                <div class="card-footer bg-transparent">
                    <a href="{{ route('movies.create') }}" class="btn btn-sm btn-outline-primary">Add Movie</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
