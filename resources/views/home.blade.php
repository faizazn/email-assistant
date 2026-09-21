@extends('layouts.app')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Compose</h1>
    <p class="text-slate-500 mt-1">Select a contact and a prompt to generate your message.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Compose Pane --}}
    <div class="lg:col-span-1">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden sticky top-24">
            <div class="px-6 py-5 border-b border-slate-100">
                <div class="flex items-center gap-2">
                    <div class="w-2 h-2 rounded-full bg-indigo-500"></div>
                    <h2 class="font-semibold text-slate-900">Compose</h2>
                </div>
            </div>

            <div class="p-6">
                <form action="{{ route('agent.generate') }}" method="post" class="space-y-5">
                    @csrf
                    <input type="hidden" name="contact_id" value="{{ session('contact_id') }}">
                    <input type="hidden" name="prompt_id" value="{{ session('prompt_id') }}">

                    <div>
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">
                            Recipient
                        </label>
                        <div class="flex items-center gap-3 p-3 bg-slate-50 rounded-xl border border-slate-200 min-h-[52px]">
                            @php $selectedContact = $contacts->find(session('contact_id')); @endphp
                            @if($selectedContact)
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-500 to-violet-500 flex items-center justify-center text-white text-xs font-semibold flex-shrink-0">
                                    {{ strtoupper(substr($selectedContact->name, 0, 1)) }}
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm font-medium text-slate-900 truncate">{{ $selectedContact->name }}</p>
                                    <p class="text-xs text-slate-500 truncate">{{ $selectedContact->email }}</p>
                                </div>
                            @else
                                <p class="text-sm text-slate-400">Choose a contact from the list →</p>
                            @endif
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">
                            Prompt
                        </label>
                        <div class="p-3 bg-slate-50 rounded-xl border border-slate-200 min-h-[120px]">
                            @php $selectedPrompt = $prompts->find(session('prompt_id')); @endphp
                            @if($selectedPrompt)
                                <p class="text-sm text-slate-700 leading-relaxed">{{ $selectedPrompt->prompt }}</p>
                            @else
                                <p class="text-sm text-slate-400">Choose a prompt from the list →</p>
                            @endif
                        </div>
                    </div>

                    @if (session('contact_id') && session('prompt_id'))
                        <button class="w-full flex items-center justify-center gap-2 bg-indigo-600 text-white py-3 rounded-xl hover:bg-indigo-700 transition font-medium shadow-sm hover:shadow-md">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            Generate message
                        </button>
                    @else
                        <div class="w-full text-center py-3 text-sm text-slate-400 bg-slate-50 rounded-xl border border-dashed border-slate-200">
                            Select contact & prompt to continue
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>

    {{-- Contacts --}}
    <div>
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                <h3 class="font-semibold text-slate-900">Contacts</h3>
                <a href="{{ route('contacts.create') }}" class="text-xs font-medium text-indigo-600 hover:text-indigo-700">
                    + Add
                </a>
            </div>
            <ul class="divide-y divide-slate-100 max-h-[480px] overflow-y-auto">
                @forelse ($contacts as $contact)
                    @php $isActive = session('contact_id') === $contact->id; @endphp
                    <li>
                        <a href="{{ route('contacts.choose', $contact->id) }}" 
                           class="flex items-center gap-3 px-6 py-3 hover:bg-slate-50 transition {{ $isActive ? 'bg-indigo-50 border-l-4 border-indigo-600' : 'border-l-4 border-transparent' }}">
                            <div class="w-9 h-9 rounded-full {{ $isActive ? 'bg-indigo-600' : 'bg-slate-200' }} flex items-center justify-center text-white text-xs font-semibold flex-shrink-0 transition">
                                {{ strtoupper(substr($contact->name, 0, 1)) }}
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-medium text-slate-900 truncate">{{ $contact->name }}</p>
                                <p class="text-xs text-slate-500 truncate">{{ $contact->email }}</p>
                            </div>
                            @if($isActive)
                                <svg class="w-4 h-4 text-indigo-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            @endif
                        </a>
                    </li>
                @empty
                    <li class="px-6 py-12 text-center">
                        <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <p class="text-sm text-slate-400 mb-2">No contacts yet</p>
                        <a href="{{ route('contacts.create') }}" class="text-xs font-medium text-indigo-600 hover:text-indigo-700">
                            Add your first contact →
                        </a>
                    </li>
                @endforelse
            </ul>
        </div>
    </div>

    {{-- Prompts --}}
    <div>
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                <h3 class="font-semibold text-slate-900">Prompts</h3>
                <a href="{{ route('prompts.create') }}" class="text-xs font-medium text-indigo-600 hover:text-indigo-700">
                    + Add
                </a>
            </div>
            <ul class="divide-y divide-slate-100 max-h-[480px] overflow-y-auto">
                @forelse ($prompts as $prompt)
                    @php $isActive = session('prompt_id') === $prompt->id; @endphp
                    <li>
                        <a href="{{ route('prompts.choose', $prompt->id) }}" 
                           class="block px-6 py-4 hover:bg-slate-50 transition {{ $isActive ? 'bg-indigo-50 border-l-4 border-indigo-600' : 'border-l-4 border-transparent' }}">
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-lg {{ $isActive ? 'bg-indigo-600' : 'bg-slate-100' }} flex items-center justify-center flex-shrink-0 mt-0.5 transition">
                                    <svg class="w-4 h-4 {{ $isActive ? 'text-white' : 'text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <p class="text-sm text-slate-700 leading-relaxed line-clamp-2 flex-1">{{ $prompt->prompt }}</p>
                            </div>
                        </a>
                    </li>
                @empty
                    <li class="px-6 py-12 text-center">
                        <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p class="text-sm text-slate-400 mb-2">No prompts yet</p>
                        <a href="{{ route('prompts.create') }}" class="text-xs font-medium text-indigo-600 hover:text-indigo-700">
                            Add your first prompt →
                        </a>
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection