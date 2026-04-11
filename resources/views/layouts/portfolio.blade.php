<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'DocPhils') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen">
    <nav class="bg-gray-950/95 border-b border-gray-800 sticky top-0 z-40">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <a wire:navigate href="{{ route('welcome') }}" class="flex items-center gap-3">
                    <img src="{{ asset('images/profileImage.jpg') }}" alt="Profile" class="h-9 w-9 rounded-full object-cover">
                    <span class="font-semibold text-lg">DocPhils</span>
                </a>
                <div class="hidden md:flex items-center gap-6 text-sm">
                    <a wire:navigate href="{{ route('welcome') }}#about" class="hover:text-white/80">About</a>
                    <a wire:navigate href="{{ route('projects.index') }}" class="hover:text-white/80">Projects</a>
                    <a wire:navigate href="{{ route('welcome') }}#contact" class="hover:text-white/80">Contact</a>
                    @auth
                        <a wire:navigate href="{{ route('dashboard') }}" class="rounded-md bg-blue-600 px-3 py-2 font-medium hover:bg-blue-500">Dashboard</a>
                    @endauth
                </div>
                <button id="menu-button" class="md:hidden rounded-md border border-gray-700 p-2 text-gray-200">
                    Menu
                </button>
            </div>
            <div id="mobile-menu" class="hidden pb-4 md:hidden">
                <div class="space-y-2 text-sm">
                    <a wire:navigate href="{{ route('welcome') }}#about" class="block rounded px-2 py-1 hover:bg-gray-800">About</a>
                    <a wire:navigate href="{{ route('projects.index') }}" class="block rounded px-2 py-1 hover:bg-gray-800">Projects</a>
                    <a wire:navigate href="{{ route('welcome') }}#contact" class="block rounded px-2 py-1 hover:bg-gray-800">Contact</a>
                    @auth
                        <a wire:navigate href="{{ route('dashboard') }}" class="block rounded bg-blue-600 px-2 py-1 hover:bg-blue-500">Dashboard</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{ $slot }}

    @livewireScripts
</body>
</html>
