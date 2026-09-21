@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto">
    <div class="mb-8">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-1 text-sm text-slate-500 hover:text-slate-700 mb-3 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back
        </a>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Edit prompt</h1>
        <p class="text-slate-500 mt-1 text-sm">Update your prompt text.</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
        <form action="{{ route('prompts.update', $prompt->id) }}" method="post" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="prompt" class="block text-sm font-medium text-slate-700 mb-2">Prompt <span class="text-red-500">*</span></label>
                <textarea rows="6" name="prompt" id="prompt"
                    class="w-full px-4 py-3 rounded-xl border bg-slate-50 text-sm transition focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white resize-none
                    @error('prompt') border-red-300 focus:border-red-500 focus:ring-red-500/20 @else border-slate-200 @enderror">{{ old('prompt', $prompt->prompt) }}</textarea>
                @error('prompt')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button class="flex-1 bg-indigo-600 text-white px-4 py-2.5 rounded-xl hover:bg-indigo-700 transition text-sm font-medium shadow-sm hover:shadow-md">
                    Update prompt
                </button>
                <a href="{{ route('home') }}" class="px-4 py-2.5 rounded-xl text-slate-600 hover:bg-slate-100 transition text-sm font-medium">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection