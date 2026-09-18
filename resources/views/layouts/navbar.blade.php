<nav class="flex justify-center gap-6 py-4 border-b border-gray-200">
    <a href="{{ route('home') }}" class="text-gray-700 hover:text-indigo-600 font-medium">Home</a>
    <a href="{{ route('contacts.create') }}" class="text-gray-700 hover:text-indigo-600 font-medium">Add Contact</a>
    <a href="{{ route('prompts.create') }}" class="text-gray-700 hover:text-indigo-600 font-medium">Add Prompt</a>

    @auth
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-gray-700 hover:text-indigo-600 font-medium">
                Logout ({{ auth()->user()->name }})
            </button>
        </form>
    @else
        <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 font-medium">Login</a>
        <a href="{{ route('register') }}" class="text-gray-700 hover:text-indigo-600 font-medium">Register</a>
    @endauth
</nav>