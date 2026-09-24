<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePromptRequest;
use App\Models\Category;
use App\Models\Prompt;

class PromptController extends Controller
{
    public function create()
    {
        $categories = Category::all();

        return view('prompts.create', compact('categories'));
    }

    public function store(StorePromptRequest $request)
    {
        Prompt::create($request->validated());

        return to_route('home')->with('success', 'Prompt added successfully.');
    }

    public function edit(Prompt $prompt)
    {
        $categories = Category::all();

        return view('prompts.edit', compact('prompt', 'categories'));
    }

    public function update(StorePromptRequest $request, Prompt $prompt)
    {
        $prompt->update($request->validated());

        return to_route('home')->with('success', 'Prompt updated successfully.');
    }

    public function destroy(Prompt $prompt)
    {
        $prompt->delete();

        return to_route('home')->with('success', 'Prompt deleted successfully.');
    }

    public function choosePrompt(Prompt $prompt)
    {
        session()->put('prompt_id', $prompt->id);

        return back();
    }
}