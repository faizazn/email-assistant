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
        Prompt::create($request->validated());

        return to_route('home')->with('success', 'Prompt added successfully.');
    }

    public function choosePrompt(Prompt $prompt)
    {
        session()->put('prompt_id', $prompt->id);

        return back();
    }
}