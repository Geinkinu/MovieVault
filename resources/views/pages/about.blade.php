@extends('layouts.main')

@section('title', 'About')

@section('content')
<div class="container py-4">
    <h2 class="mb-3">About MovieVault</h2>

    <div class="card">
        <div class="card-body">
            <p class="mb-2">
                MovieVault is a single-user Laravel 10 application to manage a movie catalogue.
            </p>
            <ul class="mb-0">
                <li>Organise movies into categories</li>
                <li>Add reviews per movie</li>
                <li>SEO-friendly URLs using slugs</li>
                <li>Filtering and sorting of movies</li>
                <li>OMDb validation when creating/updating movies</li>
            </ul>
        </div>
    </div>
</div>
@endsection
