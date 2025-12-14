<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'author' => ['nullable', 'string', 'max:255'],
            'rating' => ['nullable', 'integer', 'between:1,5'],
            'content' => ['required', 'string'],
        ]);

        $movie->reviews()->create([
            'author' => $validated['author'] ?? null,
            'rating' => $validated['rating'] ?? null,
            'content' => $validated['content'],
        ]);

        return redirect()->route('movies.show', $movie->slug);
    }

    public function edit(Movie $movie, Review $review)
    {
        // Safety: ensure review belongs to movie
        if ($review->movie_id !== $movie->id) {
            abort(404);
        }

        return view('reviews.edit', compact('movie', 'review'));
    }

    public function update(Request $request, Movie $movie, Review $review)
    {
        if ($review->movie_id !== $movie->id) {
            abort(404);
        }

        $validated = $request->validate([
            'author' => ['nullable', 'string', 'max:255'],
            'rating' => ['nullable', 'integer', 'between:1,5'],
            'content' => ['required', 'string'],
        ]);

        $review->update([
            'author' => $validated['author'] ?? null,
            'rating' => $validated['rating'] ?? null,
            'content' => $validated['content'],
        ]);

        return redirect()->route('movies.show', $movie->slug);
    }

    public function destroy(Movie $movie, Review $review)
    {
        if ($review->movie_id !== $movie->id) {
            abort(404);
        }

        $review->delete();
        return redirect()->route('movies.show', $movie->slug);
    }
}
