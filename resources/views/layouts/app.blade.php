<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DocPhils') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased text-gray-100">
    <div class="min-h-screen bg-slate-950">
        @include('layouts.navigation')
        <!-- Page Heading -->
        @if (isset($header))
            <header class="border-b border-slate-800 bg-slate-900/90 shadow-sm">
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            @if (session('success'))
                <div class="mx-auto mt-4 max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="rounded-md border border-emerald-500/40 bg-emerald-500/10 p-3 text-sm text-emerald-200">
                        {{ session('success') }}
                    </div>
                </div>
            @endif
            @if (session('error'))
                <div class="mx-auto mt-4 max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="rounded-md border border-red-500/40 bg-red-500/10 p-3 text-sm text-red-200">
                        {{ session('error') }}
                    </div>
                </div>
            @endif
            {{ $slot }}
        </main>
    </div>
    @livewireScripts
</body>

</html>
