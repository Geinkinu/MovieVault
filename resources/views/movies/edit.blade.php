@extends('layouts.main')

@section('title', 'Edit Movie')

@section('content')
<div class="container py-4">
    <h2 class="mb-3">Edit Movie</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('movies.update', $movie->slug) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category_id" class="form-select" required>
                <option value="">Select a category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $movie->category_id) == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $movie->title) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Release Year</label>
            <input type="number" name="release_year" class="form-control" value="{{ old('release_year', $movie->release_year) }}" min="1888" max="{{ date('Y') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">IMDb ID (optional)</label>
            <input type="text" name="imdb_id" class="form-control" value="{{ old('imdb_id', $movie->imdb_id) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Poster URL (optional)</label>
            <input type="url" name="poster" class="form-control" value="{{ old('poster', $movie->poster) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Description (optional)</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description', $movie->description) }}</textarea>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('movies.show', $movie->slug) }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
