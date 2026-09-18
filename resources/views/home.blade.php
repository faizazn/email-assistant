@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 my-8">

    <div>
        <form action="{{ route('prompt.send') }}" method="post" class="space-y-4">
            @csrf
            <input type="hidden" name="contact_id" value="{{ session('contact_id') }}">
            <input type="hidden" name="prompt_id" value="{{ session('prompt_id') }}">

            <input
                type="text"
                placeholder="Choose a contact from the list"
                class="w-full rounded-md border-gray-300 bg-gray-50 shadow-sm"
                value="{{ optional($contacts->find(session('contact_id')))->name }}"
                readonly
            >

            <textarea
                rows="5"
                placeholder="Choose a prompt from the list"
                class="w-full rounded-md border-gray-300 bg-gray-50 shadow-sm"
                readonly
            >{{ optional($prompts->find(session('prompt_id')))->prompt }}</textarea>

            @if (session('contact_id') && session('prompt_id'))
                <button class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">
                    Submit
                </button>
            @endif
        </form>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h5 class="font-semibold text-gray-800">List of contacts</h5>
        </div>
        <ul class="divide-y divide-gray-200">
            @foreach ($contacts as $contact)
                <li>
                    <a href="{{ route('contacts.choose', $contact->id) }}"
                       class="block px-6 py-3 hover:bg-gray-50 {{ session('contact_id') === $contact->id ? 'bg-indigo-600 text-white hover:bg-indigo-600' : 'text-gray-700' }}">
                        {{ $contact->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h5 class="font-semibold text-gray-800">List of prompts</h5>
        </div>
        <ul class="divide-y divide-gray-200">
            @foreach ($prompts as $prompt)
                <li>
                    <a href="{{ route('prompts.choose', $prompt->id) }}"
                       class="block px-6 py-3 hover:bg-gray-50 {{ session('prompt_id') === $prompt->id ? 'bg-indigo-600 text-white hover:bg-indigo-600' : 'text-gray-700' }}">
                        {{ $prompt->prompt }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

</div>
@endsection