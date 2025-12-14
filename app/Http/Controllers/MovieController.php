<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    public function index()
    {
        return 'Movies index (controller placeholder)';
    }

    public function create()
    {
        return 'Movies create (controller placeholder)';
    }

    public function store(Request $request)
    {
        return 'Movies store (controller placeholder)';
    }

    public function show(Movie $movie)
    {
        return 'Movies show (controller placeholder) ' . $movie->slug;
    }

    public function edit(Movie $movie)
    {
        return 'Movies edit (controller placeholder) ' . $movie->slug;
    }

    public function update(Request $request, Movie $movie)
    {
        return 'Movies update (controller placeholder) ' . $movie->slug;
    }

    public function destroy(Movie $movie)
    {
        return 'Movies destroy (controller placeholder) ' . $movie->slug;
    }
}
