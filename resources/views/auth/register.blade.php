<x-guest-layout>
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Create your account</h1>
        <p class="text-slate-500 mt-1 text-sm">Start composing AI-powered emails in minutes.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-slate-700 mb-2">Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                class="w-full px-4 py-2.5 rounded-xl border bg-slate-50 text-sm transition focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white
                @error('name') border-red-300 @else border-slate-200 @enderror"
                placeholder="John Doe">
            @error('name')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-slate-700 mb-2">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                class="w-full px-4 py-2.5 rounded-xl border bg-slate-50 text-sm transition focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white
                @error('email') border-red-300 @else border-slate-200 @enderror"
                placeholder="you@example.com">
            @error('email')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-slate-700 mb-2">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                class="w-full px-4 py-2.5 rounded-xl border bg-slate-50 text-sm transition focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white
                @error('password') border-red-300 @else border-slate-200 @enderror"
                placeholder="••••••••">
            @error('password')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-2">Confirm password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-sm transition focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white"
                placeholder="••••••••">
            @error('password_confirmation')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <button class="w-full bg-slate-900 text-white py-2.5 rounded-xl hover:bg-slate-800 transition font-medium shadow-sm hover:shadow-md">
            Create account
        </button>

        <p class="text-center text-sm text-slate-500 pt-2">
            Already registered?
            <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-700">Sign in</a>
        </p>
    </form>
</x-guest-layout>