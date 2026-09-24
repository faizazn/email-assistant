<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Prompt;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('prompts')->latest()->get();

        return view('categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create($request->only('name'));

        return to_route('categories.index')->with('success', 'Category added successfully.');
    }

    public function choose(Category $category)
    {
        session()->put('category_id', $category->id);
        session()->forget('prompt_id');

        return to_route('home');
    }

    public function clear()
    {
        session()->forget('category_id');

        return to_route('home');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return to_route('categories.index')->with('success', 'Category deleted.');
    }
}