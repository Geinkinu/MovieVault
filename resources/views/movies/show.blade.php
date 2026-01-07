@extends('layouts.main')

@section('title', $movie->title)

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-start mb-3">
        <div>
            <h2 class="mb-1">{{ $movie->title }}</h2>
            <div class="text-light opacity-75">
                Released: {{ $movie->release_year ?? 'Unknown' }}
                @if($movie->date_watched)
                    • Watched: {{ $movie->date_watched }}
                @endif

                @if($movie->category)
                    • Category: <a class="link-light" href="{{ route('categories.show', $movie->category->slug) }}">{{ $movie->category->name }}</a>
                @endif
            </div>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('movies.edit', $movie->slug) }}" class="btn btn-outline-light">Edit</a>
            <form method="POST" action="{{ route('movies.destroy', $movie->slug) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this movie?')">Delete</button>
            </form>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            @if($movie->poster)
                <img src="{{ $movie->poster }}" class="img-fluid rounded" alt="{{ $movie->title }} poster">
            @else
                <div class="border rounded p-4 text-center text-muted">No poster</div>
            @endif
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-2">Description</h5>
                    <p class="mb-0">{{ $movie->description ?? 'No description available.' }}</p>
                </div>
            </div>

            <div class="mt-3 text-light opacity-75">
                @if($movie->imdb_id)
                    IMDb: {{ $movie->imdb_id }}
                @endif
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Add Review</h5>

            @if($errors->review->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->review->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('reviews.store', $movie->slug) }}" novalidate>
                @csrf

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Author (optional)</label>
                        <input
                            type="text"
                            name="author"
                            class="form-control @if($errors->review->has('author')) is-invalid @endif"
                            value="{{ old('author') }}"
                        >
                        @if($errors->review->has('author'))
                            <div class="invalid-feedback">{{ $errors->review->first('author') }}</div>
                        @endif
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Rating (1–5)</label>
                        <input
                            type="text"
                            name="rating"
                            class="form-control @if($errors->review->has('rating')) is-invalid @endif"
                            value="{{ old('rating') }}"
                            placeholder="1 to 5"
                        >
                        @if($errors->review->has('rating'))
                            <div class="invalid-feedback">{{ $errors->review->first('rating') }}</div>
                        @endif
                    </div>

                    <div class="col-12">
                        <label class="form-label">Review</label>
                        <textarea
                            name="content"
                            rows="4"
                            class="form-control @if($errors->review->has('content')) is-invalid @endif"
                        >{{ old('content') }}</textarea>

                        @if($errors->review->has('content'))
                            <div class="invalid-feedback">
                                {{ $errors->review->first('content') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="d-flex gap-2 mt-3">
                    <button type="submit" class="btn btn-primary">Save Review</button>
                </div>
            </form>
        </div>
    </div>

    <h5 class="mb-3">Reviews</h5>

    @forelse($movie->reviews as $review)
        <div class="card mb-2">
            <div class="card-body d-flex justify-content-between align-items-start">
                <div>
                    <strong>{{ $review->author ?? 'Anonymous' }}</strong>
                    <div class="text-white">Rating: {{ $review->rating ?? '-' }}/5</div>
                    <p class="mb-0 mt-2">{{ $review->content }}</p>
                </div>

                <div class="d-flex gap-2">
                    <a class="btn btn-sm btn-outline-primary" href="{{ route('reviews.edit', [$movie->slug, $review->id]) }}">
                        Edit
                    </a>

                    <form method="POST" action="{{ route('reviews.destroy', [$movie->slug, $review->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this review?')">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="text-white">No reviews yet.</div>
    @endforelse
</div>
@endsection
