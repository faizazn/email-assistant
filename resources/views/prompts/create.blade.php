@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto">
    <h2 class="font-semibold text-slate-900 text-xl mb-6">Add a prompt</h2>

    <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-6">
        <form action="{{ route('prompts.store') }}" method="post" class="space-y-4">
            @csrf
            <div>
                <label for="prompt" class="block text-xs font-medium text-slate-500 mb-1">Prompt</label>
                <textarea rows="5" name="prompt" id="prompt" placeholder="Enter your prompt message"
                    class="w-full rounded-lg p-2 border border-slate-400 text-sm @error('prompt') border-red-400 @enderror">{{ old('prompt') }}</textarea>
                @error('prompt')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="category_id" class="block text-xs font-medium text-slate-500 mb-1">Category (optional)</label>
                <select name="category_id" id="category_id" class="w-full rounded-lg border border-slate-400 text-sm p-2">
                    <option value="">— No category —</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="w-full bg-indigo-600 text-white py-2.5 rounded-lg hover:bg-indigo-700 transition text-sm font-medium shadow-sm">
                Save prompt
            </button>
        </form>
    </div>
</div>
@endsection