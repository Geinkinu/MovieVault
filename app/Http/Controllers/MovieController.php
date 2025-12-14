<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Rules\OmdbMovieExists;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('name')->get();

        $query = Movie::query()->with('category');

        // Filter by category (slug)
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->get('category'));
            });
        }

        // Sorting
        $sort = $request->get('sort', 'title');
        $direction = $request->get('direction', 'asc');

        $allowedSorts = ['title', 'release_year'];
        if (!in_array($sort, $allowedSorts, true)) {
            $sort = 'title';
        }

        $allowedDirections = ['asc', 'desc'];
        if (!in_array($direction, $allowedDirections, true)) {
            $direction = 'asc';
        }

        $movies = $query->orderBy($sort, $direction)->get();

        return view('movies.index', compact('movies', 'categories', 'sort', 'direction'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('movies.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255', new OmdbMovieExists($request->input('imdb_id'), $request->input('release_year'))],
            'release_year' => ['nullable', 'integer', 'between:1888,' . (int) date('Y')],
            'imdb_id' => ['nullable', 'string', 'max:20'],
            'poster' => ['nullable', 'url'],
            'description' => ['nullable', 'string'],
        ]);

        $slug = Str::slug($validated['title']);

        $baseSlug = $slug;
        $i = 2;
        while (Movie::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $i;
            $i++;
        }

        $movie = Movie::create([
            'category_id' => $validated['category_id'],
            'title' => $validated['title'],
            'slug' => $slug,
            'release_year' => $validated['release_year'] ?? null,
            'imdb_id' => $validated['imdb_id'] ?? null,
            'poster' => $validated['poster'] ?? null,
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->route('movies.show', $movie->slug);
    }

    public function show(Movie $movie)
    {
        $movie->load(['category', 'reviews']);
        return view('movies.show', compact('movie'));
    }

    public function edit(Movie $movie)
    {
        $categories = Category::orderBy('name')->get();
        return view('movies.edit', compact('movie', 'categories'));
    }

    public function update(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255', new OmdbMovieExists($request->input('imdb_id'), $request->input('release_year'))],
            'release_year' => ['nullable', 'integer', 'between:1888,' . (int) date('Y')],
            'imdb_id' => ['nullable', 'string', 'max:20'],
            'poster' => ['nullable', 'url'],
            'description' => ['nullable', 'string'],
        ]);

        $newSlug = Str::slug($validated['title']);
        $baseSlug = $newSlug;
        $i = 2;

        while (Movie::where('slug', $newSlug)->where('id', '!=', $movie->id)->exists()) {
            $newSlug = $baseSlug . '-' . $i;
            $i++;
        }

        $movie->update([
            'category_id' => $validated['category_id'],
            'title' => $validated['title'],
            'slug' => $newSlug,
            'release_year' => $validated['release_year'] ?? null,
            'imdb_id' => $validated['imdb_id'] ?? null,
            'poster' => $validated['poster'] ?? null,
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->route('movies.show', $movie->slug);
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect()->route('movies.index');
    }
}
