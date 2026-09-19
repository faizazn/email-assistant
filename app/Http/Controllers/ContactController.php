<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = auth()->user()->contacts()->latest()->get();
        $prompts  = auth()->user()->prompts()->latest()->get();

        return view('home', compact('contacts', 'prompts'));
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

    public function chooseContact(Contact $contact)
    {
        // Sécurité: تأكد الـ contact ديال user الحالي
        abort_if($contact->user_id !== auth()->id(), 403);

        session()->put('contact_id', $contact->id);

        return back();
    }
}