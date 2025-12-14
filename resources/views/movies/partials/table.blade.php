@if($movies->count() === 0)
    <div class="alert alert-info mb-0">No movies found.</div>
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
