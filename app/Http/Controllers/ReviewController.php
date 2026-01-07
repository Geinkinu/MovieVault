<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Movie;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request, Movie $movie)
    {
        $validated = $request->validated();

        $movie->reviews()->create($validated);

        return redirect()->route('movies.show', $movie->slug);
    }

    public function edit(Movie $movie, Review $review)
    {
        if ($review->movie_id !== $movie->id) {
            abort(404);
        }

        return view('reviews.edit', compact('movie', 'review'));
    }

    public function update(UpdateReviewRequest $request, Movie $movie, Review $review)
    {
        if ($review->movie_id !== $movie->id) {
            abort(404);
        }

        $validated = $request->validated();
        $review->update($validated);

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
