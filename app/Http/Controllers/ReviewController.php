<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(Request $request, Movie $movie)
    {
        return 'Reviews store (controller placeholder) for movie ' . $movie->slug;
    }

    public function edit(Movie $movie, Review $review)
    {
        return 'Reviews edit (controller placeholder) ' . $review->id . ' for movie ' . $movie->slug;
    }

    public function update(Request $request, Movie $movie, Review $review)
    {
        return 'Reviews update (controller placeholder) ' . $review->id . ' for movie ' . $movie->slug;
    }

    public function destroy(Movie $movie, Review $review)
    {
        return 'Reviews destroy (controller placeholder) ' . $review->id . ' for movie ' . $movie->slug;
    }
}
