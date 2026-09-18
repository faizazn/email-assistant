@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto my-8">
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h4 class="text-lg font-semibold text-gray-800">Add new prompt</h4>
        </div>
        <div class="px-6 py-6">
            <form action="{{ route('prompts.store') }}" method="post" class="space-y-4">
                @csrf
                <div>
                    <label for="prompt" class="block text-sm font-medium text-gray-700 mb-1">Prompt*</label>
                    <textarea rows="5" name="prompt" id="prompt"
                        placeholder="Prompt*"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('prompt') border-red-500 @enderror"></textarea>
                    @error('prompt')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <button class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">
                    Submit
                </button>
            </form>
        </div>
    </div>
</div>
@endsection