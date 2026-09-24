@extends('layouts.app')

@section('content')

{{-- Stepper --}}
<div class="flex items-center justify-center gap-3 mb-8 text-sm">
    <div class="flex items-center gap-2 {{ session('contact_id') ? 'text-indigo-600' : 'text-slate-900' }}">
        <span class="flex items-center justify-center w-6 h-6 rounded-full text-xs font-semibold
            {{ session('contact_id') ? 'bg-indigo-600 text-white' : 'bg-slate-900 text-white' }}">
            @if (session('contact_id'))
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                </svg>
            @else
                1
            @endif
        </span>
        <span class="font-medium">Pick a contact</span>
    </div>
    <div class="w-8 h-px bg-slate-200"></div>
    <div class="flex items-center gap-2 {{ session('prompt_id') ? 'text-indigo-600' : (session('contact_id') ? 'text-slate-900' : 'text-slate-400') }}">
        <span class="flex items-center justify-center w-6 h-6 rounded-full text-xs font-semibold
            {{ session('prompt_id') ? 'bg-indigo-600 text-white' : (session('contact_id') ? 'bg-slate-900 text-white' : 'bg-slate-200 text-slate-400') }}">
            @if (session('prompt_id'))
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                </svg>
            @else
                2
            @endif
        </span>
        <span class="font-medium">Pick a prompt</span>
    </div>
    <div class="w-8 h-px bg-slate-200"></div>
    <div class="flex items-center gap-2 {{ (session('contact_id') && session('prompt_id')) ? 'text-slate-900' : 'text-slate-400' }}">
        <span class="flex items-center justify-center w-6 h-6 rounded-full text-xs font-semibold
            {{ (session('contact_id') && session('prompt_id')) ? 'bg-slate-900 text-white' : 'bg-slate-200 text-slate-400' }}">
            3
        </span>
        <span class="font-medium">Generate &amp; send</span>
    </div>
</div>

{{-- Selection row --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- Contacts --}}
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-semibold text-slate-900 text-sm">Contacts</h3>
            <a href="{{ route('contacts.create') }}" class="text-xs font-medium text-indigo-600 hover:text-indigo-700">
                + Add
            </a>
        </div>
        <ul class="divide-y divide-slate-100 max-h-72 overflow-y-auto">
            @forelse ($contacts as $contact)
                @php $isSelected = session('contact_id') === $contact->id; @endphp
                <li>
                    <a href="{{ route('contacts.choose', $contact->id) }}"
                       class="flex items-center gap-3 px-5 py-3 text-sm transition {{ $isSelected ? 'bg-indigo-50' : 'hover:bg-slate-50' }}">
                        <span class="flex items-center justify-center w-8 h-8 rounded-full text-xs font-semibold text-white
                            bg-gradient-to-br from-indigo-600 to-violet-600 shrink-0">
                            {{ strtoupper(substr($contact->name, 0, 1)) }}
                        </span>
                        <span class="flex-1 min-w-0">
                            <span class="block text-slate-800 truncate">{{ $contact->name }}</span>
                            <span class="block text-xs text-slate-400 truncate">{{ $contact->email }}</span>
                        </span>
                        @if ($isSelected)
                            <svg class="w-4 h-4 text-indigo-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                        @endif
                    </a>
                </li>
            @empty
                <li class="px-5 py-8 text-center">
                    <p class="text-sm text-slate-400 mb-2">No contacts yet.</p>
                    <a href="{{ route('contacts.create') }}" class="text-sm font-medium text-indigo-600 hover:underline">
                        Add your first contact
                    </a>
                </li>
            @endforelse
        </ul>
    </div>

    {{-- Prompts --}}
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-semibold text-slate-900 text-sm">Prompts</h3>
            <a href="{{ route('categories.index') }}" class="text-xs font-medium text-indigo-600 hover:text-indigo-700">
                Categories
            </a>
        </div>

        @if ($activeCategory)
            <div class="px-5 py-2 bg-indigo-50 text-xs text-indigo-700 flex items-center justify-between">
                <span>Showing: {{ $activeCategory->name }}</span>
                <a href="{{ route('categories.clear') }}" class="font-medium hover:underline">Clear</a>
            </div>
        @endif

        <ul class="divide-y divide-slate-100 max-h-72 overflow-y-auto">
            @forelse ($prompts as $prompt)
                @php $isSelected = session('prompt_id') === $prompt->id; @endphp
                <li>
                    <a href="{{ route('prompts.choose', $prompt->id) }}"
                       class="flex items-start gap-3 px-5 py-3 text-sm transition {{ $isSelected ? 'bg-indigo-50' : 'hover:bg-slate-50' }}">
                        <span class="flex-1 min-w-0 text-slate-700 line-clamp-2">
                            {{ $prompt->prompt }}
                        </span>
                        @if ($isSelected)
                            <svg class="w-4 h-4 text-indigo-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                        @endif
                    </a>
                </li>
            @empty
                <li class="px-5 py-8 text-center">
                    <p class="text-sm text-slate-400">No prompts available yet.</p>
                </li>
            @endforelse
        </ul>
    </div>

</div>

{{-- Compose --}}
<div class="mt-6 bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
    <div class="px-6 py-5">
        @php
            $selectedContact = session('contact_id') ? $contacts->find(session('contact_id')) : null;
            $selectedPrompt = session('prompt_id') ? $prompts->find(session('prompt_id')) : null;
        @endphp

        @if ($selectedContact && $selectedPrompt)
            <div class="flex items-center gap-3 mb-4">
                <span class="flex items-center justify-center w-9 h-9 rounded-full text-sm font-semibold text-white
                    bg-gradient-to-br from-indigo-600 to-violet-600 shrink-0">
                    {{ strtoupper(substr($selectedContact->name, 0, 1)) }}
                </span>
                <div class="min-w-0">
                    <p class="text-sm font-medium text-slate-900">To {{ $selectedContact->name }}</p>
                    <p class="text-xs text-slate-400 truncate">{{ $selectedContact->email }}</p>
                </div>
            </div>

            <div class="bg-slate-50 border border-slate-100 rounded-lg px-4 py-3 mb-4">
                <p class="text-xs font-medium text-slate-400 mb-1">Using prompt</p>
                <p class="text-sm text-slate-600">{{ $selectedPrompt->prompt }}</p>
            </div>

            <form action="{{ route('agent.generate') }}" method="post">
                @csrf
                <input type="hidden" name="contact_id" value="{{ session('contact_id') }}">
                <input type="hidden" name="prompt_id" value="{{ session('prompt_id') }}">
                <button class="w-full bg-indigo-600 text-white py-2.5 rounded-lg hover:bg-indigo-700 transition font-medium text-sm shadow-sm">
                    Generate message
                </button>
            </form>
        @else
            <div class="text-center py-6">
                <p class="text-sm text-slate-400">
                    Pick a contact and a prompt above to compose a message.
                </p>
            </div>
        @endif
    </div>
</div>

@endsection