@extends('layouts.main')

@section('title', $movie->title)

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-start mb-3">
        <div>
            <h2 class="mb-1">{{ $movie->title }}</h2>
            <div class="text-muted">
                {{ $movie->release_year ?? 'Year unknown' }}
                @if($movie->category)
                    • {{ $movie->category->name }}
                @endif
            </div>
        </div>
        <div class="d-flex gap-2">
            <a class="btn btn-outline-primary" href="{{ route('movies.edit', $movie->slug) }}">Edit</a>
            <a class="btn btn-outline-secondary" href="{{ route('movies.index') }}">Back</a>
        </div>
    </div>

    @if($movie->poster)
        <img src="{{ $movie->poster }}" alt="Poster" class="img-fluid mb-3" style="max-height: 360px;">
    @endif

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Description</h5>
            <p class="card-text mb-0">{{ $movie->description ?? 'No description provided.' }}</p>
        </div>
    </div>

    <div class="mt-4">
        <h4 class="mb-3">Reviews</h4>

        @if($movie->reviews->count() === 0)
            <div class="alert alert-info mb-0">No reviews yet.</div>
        @else
            <div class="list-group">
                @foreach($movie->reviews as $review)
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <strong>{{ $review->author ?? 'Anonymous' }}</strong>
                            <span class="text-muted">Rating: {{ $review->rating ?? '-' }}/5</span>
                        </div>
                        <div class="mt-2">{{ $review->content }}</div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
