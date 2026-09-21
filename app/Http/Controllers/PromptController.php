<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePromptRequest;
use App\Models\Prompt;

class PromptController extends Controller
{
    public function create()
    {
        return view('prompts.create');
    }

    public function store(StorePromptRequest $request)
    {
        auth()->user()->prompts()->create($request->validated());

        return to_route('home')->with('success', 'Prompt added successfully.');
    }

    public function edit(Prompt $prompt)
    {
        abort_if($prompt->user_id !== auth()->id(), 403);

        return view('prompts.edit', compact('prompt'));
    }

    public function update(StorePromptRequest $request, Prompt $prompt)
    {
        abort_if($prompt->user_id !== auth()->id(), 403);

        $prompt->update($request->validated());

        return to_route('home')->with('success', 'Prompt updated successfully.');
    }

    public function destroy(Prompt $prompt)
    {
        abort_if($prompt->user_id !== auth()->id(), 403);

        $prompt->delete();

        return to_route('home')->with('success', 'Prompt deleted successfully.');
    }

    public function choosePrompt(Prompt $prompt)
    {
        abort_if($prompt->user_id !== auth()->id(), 403);

        session()->put('prompt_id', $prompt->id);

        return back();
    }
}