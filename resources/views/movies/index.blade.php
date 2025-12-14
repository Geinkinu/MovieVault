@extends('layouts.main')

@section('title', 'Movies')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Movies</h2>
        <a href="{{ route('movies.create') }}" class="btn btn-primary">Add Movie</a>
    </div>

    <form method="GET" action="{{ route('movies.index') }}" class="card mb-3">
        <div class="card-body">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label">Category</label>
                    <select name="category" class="form-select">
                        <option value="">All categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->slug }}"
                                @selected(request('category') === $category->slug)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Sort by</label>
                    <select name="sort" class="form-select">
                        <option value="title" @selected(request('sort', $sort ?? 'title') === 'title')>Title</option>
                        <option value="release_year" @selected(request('sort', $sort ?? 'title') === 'release_year')>Release Year</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Direction</label>
                    <select name="direction" class="form-select">
                        <option value="asc" @selected(request('direction', $direction ?? 'asc') === 'asc')>Ascending</option>
                        <option value="desc" @selected(request('direction', $direction ?? 'asc') === 'desc')>Descending</option>
                    </select>
                </div>

                <div class="col-12 d-flex gap-2">
                    <button type="submit" class="btn btn-outline-primary">Apply</button>
                    <a href="{{ route('movies.index') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </div>
        </div>
    </form>

    @include('movies.partials.table', ['movies' => $movies])
</div>
@endsection
