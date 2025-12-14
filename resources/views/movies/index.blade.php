@extends('layouts.main')

@section('title', 'Movies')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Movies</h2>
        <a href="{{ route('movies.create') }}" class="btn btn-primary">Add Movie</a>
    </div>

    @if($movies->count() === 0)
        <div class="alert alert-info mb-0">No movies yet.</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Year</th>
                        <th>Category</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($movies as $movie)
                        <tr>
                            <td>{{ $movie->title }}</td>
                            <td>{{ $movie->release_year ?? '-' }}</td>
                            <td>{{ $movie->category?->name ?? '-' }}</td>
                            <td class="text-end">
                                <a class="btn btn-sm btn-outline-secondary"
                                   href="{{ route('movies.show', $movie->slug) }}">
                                    View
                                </a>
                                <a class="btn btn-sm btn-outline-primary"
                                   href="{{ route('movies.edit', $movie->slug) }}">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
