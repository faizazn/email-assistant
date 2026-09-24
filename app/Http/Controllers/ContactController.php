<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use App\Models\Prompt;

class ContactController extends Controller
{
    public function index()
{
    $contacts = auth()->user()->contacts()->latest()->get();

    $promptsQuery = Prompt::latest();

    if (session('category_id')) {
        $promptsQuery->where('category_id', session('category_id'));
    }

    $prompts = $promptsQuery->get();

    $activeCategory = session('category_id')
        ? \App\Models\Category::find(session('category_id'))
        : null;

    return view('home', compact('contacts', 'prompts', 'activeCategory'));
}

    public function create()
    {
        return view('contacts.create');
    }

    public function store(StoreContactRequest $request)
    {
        auth()->user()->contacts()->create($request->validated());

        return to_route('home')->with('success', 'Contact added successfully.');
    }

    public function edit(Contact $contact)
    {
        abort_if($contact->user_id !== auth()->id(), 403);

        return view('contacts.edit', compact('contact'));
    }

    public function update(StoreContactRequest $request, Contact $contact)
    {
        abort_if($contact->user_id !== auth()->id(), 403);

        $contact->update($request->validated());

        return to_route('home')->with('success', 'Contact updated successfully.');
    }

    public function destroy(Contact $contact)
    {
        abort_if($contact->user_id !== auth()->id(), 403);

        $contact->delete();

        return to_route('home')->with('success', 'Contact deleted successfully.');
    }

    public function chooseContact(Contact $contact)
    {
        abort_if($contact->user_id !== auth()->id(), 403);

        session()->put('contact_id', $contact->id);

        return back();
    }
}