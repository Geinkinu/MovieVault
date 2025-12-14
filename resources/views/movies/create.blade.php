@extends('layouts.main')

@section('title', 'Add Movie')

@section('content')
    <div class="container py-4">
        <h2 class="mb-3">Add Movie</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('movies.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="category_id" class="form-select" required>
                    <option value="">Select a category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Date Watched (optional)</label>
                <input type="date" name="date_watched" class="form-control" value="{{ old('date_watched') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">IMDb ID (optional)</label>
                <input type="text" name="imdb_id" class="form-control" value="{{ old('imdb_id') }}" placeholder="tt0111161">
            </div>

            <div class="mb-3">
                <label class="form-label">Poster URL (optional)</label>
                <input type="url" name="poster" class="form-control" value="{{ old('poster') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Description (optional)</label>
                <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('movies.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection