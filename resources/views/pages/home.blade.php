@extends('layouts.main')

@section('title', 'Home')

@section('content')
<div class="container">
    <div class="mv-hero p-4 p-md-5 mb-4">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="mv-pill">Movie Catalogue</span>
                    <span class="mv-pill">Reviews</span>
                    <span class="mv-pill">OMDb Validation</span>
                </div>

                <h1 class="display-6 mb-2">MovieVault Noir</h1>
                <p class="mv-subtle mb-4">
                    Curate your library, track what you watched, and capture reviews. Movies are validated via OMDb and stored with SEO-friendly slugs.
                </p>

                <div class="d-flex flex-wrap gap-2">
                    <a class="btn mv-btn-primary" href="{{ route('movies.index') }}">Browse Movies</a>
                    <a class="btn mv-btn-ghost" href="{{ route('categories.index') }}">Browse Categories</a>
                    <a class="btn mv-btn-ghost" href="{{ route('about') }}">About</a>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="mv-card p-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="fw-semibold">Quick actions</div>
                        <span class="badge mv-badge">Single user</span>
                    </div>

                    <div class="d-grid gap-2">
                        <a class="btn mv-btn-ghost" href="{{ route('categories.create') }}">Create a Category</a>
                        <a class="btn mv-btn-primary" href="{{ route('movies.create') }}">Add a Movie</a>
                        <a class="btn mv-btn-ghost" href="{{ route('movies.index') }}">Filter & Sort Movies</a>
                    </div>

                    <hr style="border-color: rgba(255,255,255,.08)" class="my-3">

                    <div class="small mv-subtle">
                        Tip: Add a movie using title or IMDb ID. Release year is auto-populated from OMDb.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-6">
            <div class="mv-card p-4 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fw-semibold mb-1">Categories</div>
                        <div class="mv-subtle small">Organise movies into categories.</div>
                    </div>
                </div>
                <div class="mt-3">
                    <a class="btn btn-sm mv-btn-ghost" href="{{ route('categories.index') }}">Open Categories</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="mv-card p-4 h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fw-semibold mb-1">Reviews</div>
                        <div class="mv-subtle small">Add reviews directly on a movie page.</div>
                    </div>
                </div>
                <div class="mt-3">
                    <a class="btn btn-sm mv-btn-ghost" href="{{ route('movies.index') }}">Open Movies</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
