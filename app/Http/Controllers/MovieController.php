<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Models\Category;
use App\Models\Movie;
use App\Services\OmdbService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('name')->get();

        $query = Movie::query()->with('category');

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->input('category'));
            });
        }

        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where('title', 'like', "%{$q}%");
        }

        $sort = $request->input('sort', 'title');
        $dir = $request->input('dir', 'asc');

        $allowedSorts = ['title', 'release_year', 'date_watched', 'created_at'];
        if (!in_array($sort, $allowedSorts, true)) {
            $sort = 'title';
        }

        $dir = $dir === 'desc' ? 'desc' : 'asc';

        $movies = $query->orderBy($sort, $dir)->paginate(10)->appends($request->query());

        return view('movies.index', compact('movies', 'categories', 'sort', 'dir'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('movies.create', compact('categories'));
    }

    public function store(StoreMovieRequest $request)
    {
        $validated = $request->validated();

        $omdbService = app(OmdbService::class);

        $omdbData = $omdbService->fetchMovie(
            $validated['imdb_id'] ?? null,
            $validated['title']
        );

        $canonicalTitle = $validated['title'];
        if (!empty($omdbData['Title']) && $omdbData['Title'] !== 'N/A') {
            $canonicalTitle = $omdbData['Title'];
        }

        $slug = Str::slug($canonicalTitle);
        $baseSlug = $slug;
        $i = 2;

        while (Movie::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $i;
            $i++;
        }

        $releaseYear = $omdbService->extractReleaseYear($omdbData['Year'] ?? null);

        $movie = Movie::create([
            'category_id' => $validated['category_id'],
            'title' => $canonicalTitle,
            'slug' => $slug,
            'release_year' => $releaseYear,
            'date_watched' => $validated['date_watched'] ?? null,
            'imdb_id' => $validated['imdb_id'] ?? ($omdbData['imdbID'] ?? null),
            'poster' => $validated['poster']
                ?? (((($omdbData['Poster'] ?? null) !== 'N/A') ? ($omdbData['Poster'] ?? null) : null)),
            'description' => $validated['description']
                ?? (((($omdbData['Plot'] ?? null) !== 'N/A') ? ($omdbData['Plot'] ?? null) : null)),
        ]);

        return redirect()->route('movies.show', $movie->slug);
    }

    public function show(Movie $movie)
    {
        $movie->load([
            'category',
            'reviews' => function ($q) {
                $q->latest();
            }
        ]);

        return view('movies.show', compact('movie'));
    }

    public function edit(Movie $movie)
    {
        $categories = Category::orderBy('name')->get();
        return view('movies.edit', compact('movie', 'categories'));
    }

    public function update(UpdateMovieRequest $request, Movie $movie)
    {
        $validated = $request->validated();

        $omdbService = app(OmdbService::class);

        $omdbData = $omdbService->fetchMovie(
            $validated['imdb_id'] ?? null,
            $validated['title']
        );

        $canonicalTitle = $validated['title'];
        if (!empty($omdbData['Title']) && $omdbData['Title'] !== 'N/A') {
            $canonicalTitle = $omdbData['Title'];
        }
        $newSlug = Str::slug($canonicalTitle);
        $baseSlug = $newSlug;
        $i = 2;

        while (Movie::where('slug', $newSlug)->where('id', '!=', $movie->id)->exists()) {
            $newSlug = $baseSlug . '-' . $i;
            $i++;
        }

        $releaseYear = $omdbService->extractReleaseYear($omdbData['Year'] ?? null);

        $movie->update([
            'category_id' => $validated['category_id'],
            'title' => $canonicalTitle,
            'slug' => $newSlug,
            'release_year' => $releaseYear,
            'date_watched' => $validated['date_watched'] ?? null,
            'imdb_id' => $validated['imdb_id'] ?? ($omdbData['imdbID'] ?? null),
            'poster' => $validated['poster']
                ?? (((($omdbData['Poster'] ?? null) !== 'N/A') ? ($omdbData['Poster'] ?? null) : null)),
            'description' => $validated['description']
                ?? (((($omdbData['Plot'] ?? null) !== 'N/A') ? ($omdbData['Plot'] ?? null) : null)),
        ]);

        return redirect()->route('movies.show', $movie->slug);
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect()->route('movies.index');
    }
}
