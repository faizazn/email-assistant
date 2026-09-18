<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use App\Models\Prompt;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->get();
        $prompts  = Prompt::latest()->get();

        return view('home', compact('contacts', 'prompts'));
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function store(StoreContactRequest $request)
    {
        Contact::create($request->validated());

        return to_route('home')->with('success', 'Contact added successfully.');
    }

    public function chooseContact(Contact $contact)
    {
        session()->put('contact_id', $contact->id);

        return back();
    }
}