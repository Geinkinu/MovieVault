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

    <form method="POST" action="{{ route('reviews.update', [$movie->slug, $review->id]) }}" novalidate>
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Author (optional)</label>
                <input
                    type="text"
                    name="author"
                    class="form-control @error('author') is-invalid @enderror"
                    value="{{ old('author', $review->author) }}"
                >
                @error('author')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4">
                <label class="form-label">Rating (1–5, optional)</label>
                <input
                    type="text"
                    name="rating"
                    class="form-control @error('rating') is-invalid @enderror"
                    value="{{ old('rating', $review->rating) }}"
                    placeholder="1 to 5"
                >
                @error('rating')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <label class="form-label">Review</label>
                <textarea
                    name="content"
                    class="form-control @error('content') is-invalid @enderror"
                    rows="4"
                >{{ old('content', $review->content) }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="d-flex gap-2 mt-3">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('movies.show', $movie->slug) }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
