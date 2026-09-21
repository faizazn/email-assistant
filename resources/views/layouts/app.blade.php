<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ink & Wire — AI Email Composer</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-800 font-sans min-h-screen antialiased">
    <div class="min-h-screen flex flex-col">
        @include('layouts.navbar')
        
        <main class="flex-1 w-full max-w-6xl mx-auto px-6 py-8">
            @include('layouts.alerts')
            @yield('content')
        </main>
        
        <footer class="border-t border-slate-200 py-6 mt-12">
            <div class="max-w-6xl mx-auto px-6 text-center text-xs text-slate-400">
                Ink & Wire — Crafted with precision
            </div>
        </footer>
    </div>
</body>
</html>