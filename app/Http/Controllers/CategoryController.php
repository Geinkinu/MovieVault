<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->get();
        return view('categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $category->load('movies');
        return view('categories.show', compact('category'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,name'],
        ]);

        $slug = Str::slug($validated['name']);

        // Ensure slug uniqueness
        $baseSlug = $slug;
        $i = 2;
        while (Category::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $i;
            $i++;
        }

        $category = Category::create([
            'name' => $validated['name'],
            'slug' => $slug,
        ]);

        return redirect()->route('categories.show', $category->slug);
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,name,' . $category->id],
        ]);

        $newSlug = Str::slug($validated['name']);

        // Ensure slug uniqueness (excluding current category)
        $baseSlug = $newSlug;
        $i = 2;
        while (Category::where('slug', $newSlug)->where('id', '!=', $category->id)->exists()) {
            $newSlug = $baseSlug . '-' . $i;
            $i++;
        }

        $category->update([
            'name' => $validated['name'],
            'slug' => $newSlug,
        ]);

        return redirect()->route('categories.show', $category->slug);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index');
    }
}
