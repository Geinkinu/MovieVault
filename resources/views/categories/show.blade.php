@extends('layouts.main')

@section('title', $category->name)

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div>
                <h2 class="mb-1">{{ $category->name }}</h2>
                <div class="text-white">{{ $category->movies->count() }} movies</div>
            </div>
            <div class="d-flex gap-2">
                <a class="btn btn-outline-primary" href="{{ route('categories.edit', $category->slug) }}">Edit</a>

                <form method="POST" action="{{ route('categories.destroy', $category->slug) }}"
                    onsubmit="return confirm('Delete this category?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger" type="submit">Delete</button>
                </form>

                <a class="btn btn-outline-secondary" href="{{ route('categories.index') }}">Back</a>
            </div>
        </div>

        <h4 class="mb-3">Movies in this category</h4>

        @if($category->movies->count() === 0)
            <div class="alert alert-info mb-0">No movies in this category yet.</div>
        @else
            <ul class="list-group">
                @foreach($category->movies as $movie)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>{{ $movie->title }} ({{ $movie->release_year ?? '-' }})</span>
                        <a class="btn btn-sm btn-outline-secondary" href="{{ route('movies.show', $movie->slug) }}">
                            View
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection