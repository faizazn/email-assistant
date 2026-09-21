<header class="bg-white border-b border-slate-200 sticky top-0 z-50 backdrop-blur-sm bg-white/90">
    <nav class="max-w-6xl mx-auto px-6 flex items-center justify-between h-16">
        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center gap-2 group">
            <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-600 to-violet-600 flex items-center justify-center shadow-sm group-hover:shadow-md transition">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <span class="font-semibold text-slate-900 tracking-tight">Ink & Wire</span>
        </a>

        {{-- Navigation --}}
        <div class="flex items-center gap-1">
            <a href="{{ route('home') }}" class="px-3 py-2 text-sm font-medium text-slate-600 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition">
                Home
            </a>
            <a href="{{ route('contacts.create') }}" class="px-3 py-2 text-sm font-medium text-slate-600 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition">
                Contacts
            </a>
            <a href="{{ route('prompts.create') }}" class="px-3 py-2 text-sm font-medium text-slate-600 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition">
                Prompts
            </a>
            <a href="{{ route('history.index') }}" class="px-3 py-2 text-sm font-medium text-slate-600 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition">
                History
            </a>

            <div class="w-px h-6 bg-slate-200 mx-2"></div>

            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-3 py-2 text-sm font-medium text-slate-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition">
                        Log out
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="px-3 py-2 text-sm font-medium text-slate-600 hover:text-slate-900 rounded-lg transition">
                    Log in
                </a>
                <a href="{{ route('register') }}" class="ml-1 px-4 py-2 text-sm font-medium bg-slate-900 text-white rounded-lg hover:bg-slate-800 transition shadow-sm">
                    Sign up
                </a>
            @endauth
        </div>
    </nav>
</header>