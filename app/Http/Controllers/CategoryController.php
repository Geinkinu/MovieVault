<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return 'Categories create (controller placeholder)';
    }

    public function store(Request $request)
    {
        return 'Categories store (controller placeholder)';
    }

    public function show(Category $category)
    {
        $category->load('movies');
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return 'Categories edit (controller placeholder) ' . $category->slug;
    }

    public function update(Request $request, Category $category)
    {
        return 'Categories update (controller placeholder) ' . $category->slug;
    }

    public function destroy(Category $category)
    {
        return 'Categories destroy (controller placeholder) ' . $category->slug;
    }
}
