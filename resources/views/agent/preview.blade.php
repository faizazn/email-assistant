@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-1 text-sm text-slate-500 hover:text-slate-700 mb-3 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to compose
        </a>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Preview email</h1>
        <p class="text-slate-500 mt-1 text-sm">Review your generated message before sending.</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        {{-- Header --}}
        <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-violet-500 flex items-center justify-center text-white font-semibold flex-shrink-0">
                    {{ strtoupper(substr($draft->contact->name, 0, 1)) }}
                </div>
                <div class="min-w-0">
                    <p class="text-xs text-slate-500 uppercase tracking-wider font-semibold">To</p>
                    <p class="text-sm font-medium text-slate-900 truncate">
                        {{ $draft->contact->name }} <span class="text-slate-400 font-normal">&lt;{{ $draft->contact->email }}&gt;</span>
                    </p>
                </div>
            </div>
        </div>

        {{-- Body --}}
        <div class="px-6 py-6">
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-5 text-slate-700 text-sm leading-relaxed whitespace-pre-line">
                {{ $draft->generated_message }}
            </div>
        </div>

        {{-- Actions --}}
        <div class="px-6 py-5 bg-slate-50/50 border-t border-slate-100 flex flex-wrap items-center gap-3">
            <form action="{{ route('agent.send', $draft->id) }}" method="post">
                @csrf
                <button class="inline-flex items-center gap-2 bg-emerald-600 text-white px-5 py-2.5 rounded-xl hover:bg-emerald-700 transition text-sm font-medium shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                    Send email
                </button>
            </form>

            <form action="{{ route('agent.regenerate', $draft->id) }}" method="post">
                @csrf
                <button class="inline-flex items-center gap-2 bg-amber-500 text-white px-5 py-2.5 rounded-xl hover:bg-amber-600 transition text-sm font-medium shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Regenerate
                </button>
            </form>

            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-100 transition text-sm font-medium ml-auto">
                Cancel
            </a>
        </div>
    </div>
</div>
@endsection