<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ink & Wire</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-800 font-sans min-h-screen antialiased">
    <div class="min-h-screen flex flex-col items-center justify-center px-6 py-12">
        {{-- Logo --}}
        <a href="/" class="flex items-center gap-2 mb-8">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-600 to-violet-600 flex items-center justify-center shadow-lg">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <span class="font-semibold text-slate-900 text-lg tracking-tight">Ink & Wire</span>
        </a>

        {{-- Card --}}
        <div class="w-full max-w-md bg-white rounded-2xl border border-slate-200 shadow-lg p-8">
            {{ $slot }}
        </div>
    </div>
</body>
</html>