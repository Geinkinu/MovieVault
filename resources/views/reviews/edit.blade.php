@extends('layouts.main')

@section('title', 'Edit Review')

@section('content')
<div class="container py-4">
    <h2 class="mb-3">Edit Review</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('reviews.update', [$movie->slug, $review->id]) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Author (optional)</label>
            <input type="text" name="author" class="form-control" value="{{ old('author', $review->author) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Rating (1–5, optional)</label>
            <input type="number" name="rating" class="form-control" min="1" max="5" value="{{ old('rating', $review->rating) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Review</label>
            <textarea name="content" class="form-control" rows="4" required>{{ old('content', $review->content) }}</textarea>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('movies.show', $movie->slug) }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
