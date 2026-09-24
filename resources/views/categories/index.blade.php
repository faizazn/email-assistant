@extends('layouts.app')

@section('content')
<div class="max-w-6xl">
    <h2 class="font-semibold text-slate-900 text-xl mb-6">Categories</h2>

    {{-- Add + Search --}}
    <div class="flex flex-col sm:flex-row gap-4 mb-6">
        @if (auth()->user()->isAdmin())
            <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-5 flex-1">
                <form action="{{ route('categories.store') }}" method="post" class="flex gap-2">
                    @csrf
                    <input type="text" name="name" placeholder="New category name"
                        class="flex-1 rounded-lg border-slate-200 text-sm placeholder:text-slate-300">
                    <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition text-sm font-medium">
                        Add
                    </button>
                </form>
                @error('name')
                    <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        @endif

        <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-5 flex-1">
            <div class="relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z"/>
                </svg>
                <input type="text" id="categorySearch" placeholder="Search categories..."
                    class="w-full rounded-lg border-slate-200 text-sm pl-9 placeholder:text-slate-300">
            </div>
        </div>
    </div>

    {{-- Cards grid --}}
    @php
        $palette = [
            ['bg' => 'bg-indigo-50', 'text' => 'text-indigo-600'],
            ['bg' => 'bg-violet-50', 'text' => 'text-violet-600'],
            ['bg' => 'bg-amber-50', 'text' => 'text-amber-600'],
            ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-600'],
            ['bg' => 'bg-rose-50', 'text' => 'text-rose-600'],
            ['bg' => 'bg-sky-50', 'text' => 'text-sky-600'],
        ];
    @endphp

    @if ($categories->isEmpty())
        <div class="bg-white border border-slate-200 rounded-xl shadow-sm px-5 py-10 text-center">
            <p class="text-sm text-slate-400">No categories yet.</p>
        </div>
    @else
        <div id="categoryGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
            @foreach ($categories as $category)
                @php $color = $palette[$category->id % count($palette)]; @endphp
                <div class="category-card group relative bg-white border border-slate-200 rounded-xl shadow-sm hover:shadow-md hover:border-slate-300 transition p-5"
                     data-name="{{ strtolower($category->name) }}">
                    @if (auth()->user()->isAdmin())
                        <form action="{{ route('categories.destroy', $category->id) }}" method="post"
                              onsubmit="return confirm('Delete this category? Its prompts will stay, just uncategorized.')"
                              class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-slate-300 hover:text-red-600 p-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </form>
                    @endif

                    <a href="{{ route('categories.choose', $category->id) }}" class="block">
                        <span class="inline-flex items-center justify-center w-9 h-9 rounded-lg {{ $color['bg'] }} {{ $color['text'] }} mb-3">
                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                            </svg>
                        </span>
                        <p class="font-medium text-slate-800 text-sm mb-1">{{ $category->name }}</p>
                        <p class="text-xs text-slate-400">{{ $category->prompts_count }} {{ Str::plural('prompt', $category->prompts_count) }}</p>
                    </a>
                </div>
            @endforeach
        </div>

        <p id="noResults" class="hidden text-center text-sm text-slate-400 py-10">
            No categories match your search.
        </p>
    @endif
</div>

<script>
document.getElementById('categorySearch')?.addEventListener('input', function (e) {
    const query = e.target.value.trim().toLowerCase();
    const cards = document.querySelectorAll('.category-card');
    let visibleCount = 0;

    cards.forEach(card => {
        const matches = card.dataset.name.includes(query);
        card.classList.toggle('hidden', !matches);
        if (matches) visibleCount++;
    });

    document.getElementById('noResults')?.classList.toggle('hidden', visibleCount !== 0);
});
</script>
@endsection