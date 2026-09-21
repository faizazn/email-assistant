<x-guest-layout>
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Welcome back</h1>
        <p class="text-slate-500 mt-1 text-sm">Sign in to your Ink & Wire account.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-slate-700 mb-2">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                class="w-full px-4 py-2.5 rounded-xl border bg-slate-50 text-sm transition focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white
                @error('email') border-red-300 @else border-slate-200 @enderror"
                placeholder="you@example.com">
            @error('email')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-slate-700 mb-2">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="w-full px-4 py-2.5 rounded-xl border bg-slate-50 text-sm transition focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 focus:bg-white
                @error('password') border-red-300 @else border-slate-200 @enderror"
                placeholder="••••••••">
            @error('password')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center gap-2 cursor-pointer">
                <input id="remember_me" type="checkbox" name="remember"
                    class="rounded border-slate-300 text-indigo-600 shadow-sm focus:ring-indigo-500 focus:ring-offset-0">
                <span class="text-sm text-slate-600">Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-700">
                    Forgot password?
                </a>
            @endif
        </div>

        <button class="w-full bg-slate-900 text-white py-2.5 rounded-xl hover:bg-slate-800 transition font-medium shadow-sm hover:shadow-md">
            Sign in
        </button>

        <p class="text-center text-sm text-slate-500 pt-2">
            Don't have an account?
            <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-700">Sign up</a>
        </p>
    </form>
</x-guest-layout>