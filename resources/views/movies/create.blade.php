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

    <form method="POST" action="{{ route('movies.store') }}" novalidate>
        @csrf
        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                <option value="">-- Select --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input
                type="text"
                name="title"
                class="form-control @error('title') is-invalid @enderror"
                value="{{ old('title') }}"
                placeholder="e.g. Inception"
            >
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">IMDb ID (optional)</label>
            <input
                type="text"
                name="imdb_id"
                class="form-control @error('imdb_id') is-invalid @enderror"
                value="{{ old('imdb_id') }}"
                placeholder="e.g. tt1375666"
            >
            @error('imdb_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-text">Leave blank to validate by title only.</div>
        </div>

        <div class="mb-3">
            <label class="form-label">Date Watched (dd/mm/yyyy)</label>
            <input
                type="text"
                name="date_watched"
                class="form-control @error('date_watched') is-invalid @enderror"
                value="{{ old('date_watched') }}"
                placeholder="dd/mm/yyyy"
            >
            @error('date_watched')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Poster URL (optional)</label>
            <input
                type="text"
                name="poster"
                class="form-control @error('poster') is-invalid @enderror"
                value="{{ old('poster') }}"
                placeholder="https://..."
            >
            @error('poster')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Description (optional)</label>
            <textarea
                name="description"
                class="form-control @error('description') is-invalid @enderror"
                rows="4"
            >{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('movies.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
