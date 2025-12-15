@extends('layouts.main')

@section('title', 'Categories')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Categories</h2>
            <a href="{{ route('categories.create') }}" class="btn btn-primary">Add Category</a>
        </div>

        @if($categories->count() === 0)
            <div class="alert alert-info mb-0">No categories yet.</div>
        @else
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td class="text-end">
                                    <a class="btn btn-sm btn-outline-secondary"
                                        href="{{ route('categories.show', $category->slug) }}">View</a>
                                    <a class="btn btn-sm btn-outline-primary"
                                        href="{{ route('categories.edit', $category->slug) }}">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection