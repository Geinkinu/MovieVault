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

                <form method="POST" action="{{ route('movies.destroy', $movie->slug) }}"
                    onsubmit="return confirm('Delete this movie?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger" type="submit">Delete</button>
                </form>

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

            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Add Review</h5>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('reviews.store', $movie->slug) }}">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Author (optional)</label>
                                <input type="text" name="author" class="form-control" value="{{ old('author') }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Rating (1–5, optional)</label>
                                <input type="number" name="rating" class="form-control" min="1" max="5"
                                    value="{{ old('rating') }}">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Review</label>
                                <textarea name="content" class="form-control" rows="3"
                                    required>{{ old('content') }}</textarea>
                            </div>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Add Review</button>
                        </div>
                    </form>
                </div>
            </div>

            @if($movie->reviews->count() === 0)
                <div class="alert alert-info mb-0">No reviews yet.</div>
            @else
                <div class="list-group">
                    @foreach($movie->reviews as $review)
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <strong>{{ $review->author ?? 'Anonymous' }}</strong>
                                    <div class="text-muted">
                                        Rating: {{ $review->rating ?? '-' }}/5
                                    </div>
                                </div>

                                <div class="d-flex gap-2">
                                    <a class="btn btn-sm btn-outline-primary"
                                        href="{{ route('reviews.edit', [$movie->slug, $review->id]) }}">
                                        Edit
                                    </a>

                                    <form method="POST" action="{{ route('reviews.destroy', [$movie->slug, $review->id]) }}"
                                        onsubmit="return confirm('Delete this review?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div class="mt-2">
                                {{ $review->content }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection