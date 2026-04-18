<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @php
        $siteName = config('app.name', 'DocPhils');
        $rawTitle = isset($title) && trim((string) $title) !== '' ? trim((string) $title) : $siteName;
        $seoTitle = str_contains($rawTitle, $siteName) ? $rawTitle : $rawTitle . ' | ' . $siteName;
        $seoDescription =
            isset($description) && trim((string) $description) !== ''
                ? trim((string) $description)
                : 'DocPhils builds high-performance web products, case studies, and growth-ready systems for modern businesses.';
        $seoCanonical = isset($canonical) && trim((string) $canonical) !== '' ? $canonical : url()->current();
        $defaultImage = asset('images/portfolioimage.jpg');
        $seoImage =
            isset($image) && trim((string) $image) !== ''
                ? (\Illuminate\Support\Str::startsWith((string) $image, ['http://', 'https://'])
                    ? $image
                    : asset((string) $image))
                : $defaultImage;
        $seoType = isset($type) && trim((string) $type) !== '' ? $type : 'website';
        $seoRobots =
            isset($robots) && trim((string) $robots) !== ''
                ? $robots
                : 'index,follow,max-image-preview:large,max-snippet:-1,max-video-preview:-1';

        $defaultSchemas = [
            [
                '@context' => 'https://schema.org',
                '@type' => 'WebSite',
                'name' => $siteName,
                'url' => rtrim(config('app.url'), '/'),
                'inLanguage' => app()->getLocale(),
                'description' => $seoDescription,
                'potentialAction' => [
                    '@type' => 'SearchAction',
                    'target' => route('projects.index') . '?q={search_term_string}',
                    'query-input' => 'required name=search_term_string',
                ],
            ],
            [
                '@context' => 'https://schema.org',
                '@type' => 'Person',
                'name' => 'DocPhils',
                'url' => rtrim(config('app.url'), '/'),
                'jobTitle' => 'Fullstack Developer',
                'sameAs' => [],
            ],
        ];

        $schemas = [];
        if (isset($structuredData)) {
            if (is_array($structuredData) && array_key_exists('@context', $structuredData)) {
                $schemas[] = $structuredData;
            } elseif (is_array($structuredData)) {
                $schemas = $structuredData;
            }
        }
        $schemas = array_merge($defaultSchemas, $schemas);
    @endphp
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $seoTitle }}</title>
    <meta name="description" content="{{ $seoDescription }}">
    <meta name="robots" content="{{ $seoRobots }}">
    <meta name="googlebot" content="{{ $seoRobots }}">
    <meta name="author" content="{{ $siteName }}">
    <meta name="theme-color" content="#030712">
    <link rel="canonical" href="{{ $seoCanonical }}">
    <link rel="alternate" type="application/xml" title="Sitemap" href="{{ route('sitemap') }}">
    <link rel="alternate" type="text/plain" title="LLMs" href="{{ url('/llms.txt') }}">

    <meta property="og:type" content="{{ $seoType }}">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:url" content="{{ $seoCanonical }}">
    <meta property="og:image" content="{{ $seoImage }}">
    <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDescription }}">
    <meta name="twitter:image" content="{{ $seoImage }}">

    @foreach ($schemas as $schema)
        <script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
    @endforeach

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-900 text-gray-100 min-h-screen" data-home-route="{{ request()->routeIs('welcome') ? '1' : '0' }}">
    @php
        $isHomeRoute = request()->routeIs('welcome');
        $isProjectsRoute = request()->routeIs('projects.*') || request()->routeIs('case-studies.*');
        $isDashboardRoute = request()->routeIs('dashboard');

        $desktopActiveClass = 'text-white font-semibold border p-2 bg-gray-800';
        $desktopInactiveClass = 'text-gray-300 hover:text-white/80';

        $mobileActiveClass = 'bg-gray-800 text-white font-semibold';
        $mobileInactiveClass = 'text-gray-300 hover:bg-gray-800 hover:text-white';
    @endphp
    <nav class="bg-gray-950/95 border-b border-gray-800 sticky top-0 z-40" aria-label="Primary">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <a wire:navigate href="{{ route('welcome') }}" class="flex items-center gap-3">
                    <img src="{{ asset('images/profileImage.jpg') }}" alt="DocPhils profile photo"
                        class="h-9 w-9 rounded-full object-cover">
                    <span class="font-semibold text-lg">DocPhils</span>
                </a>
                <div class="hidden md:flex items-center gap-6 text-sm">
                    <a wire:navigate href="{{ route('welcome') }}"
                        class="{{ $isHomeRoute ? $desktopActiveClass : $desktopInactiveClass }}"
                        data-nav-key="home"
                        data-active-class="{{ $desktopActiveClass }}"
                        data-inactive-class="{{ $desktopInactiveClass }}"
                        aria-current="{{ $isHomeRoute ? 'page' : 'false' }}">Home</a>
                    <a wire:navigate href="{{ route('welcome') }}#about"
                        class="{{ $isHomeRoute ? $desktopActiveClass : $desktopInactiveClass }}"
                        data-nav-key="about"
                        data-active-class="{{ $desktopActiveClass }}"
                        data-inactive-class="{{ $desktopInactiveClass }}"
                        aria-current="{{ $isHomeRoute ? 'page' : 'false' }}">About</a>
                    <a wire:navigate href="{{ route('projects.index') }}"
                        class="{{ $isProjectsRoute ? $desktopActiveClass : $desktopInactiveClass }}"
                        data-nav-key="projects"
                        data-active-class="{{ $desktopActiveClass }}"
                        data-inactive-class="{{ $desktopInactiveClass }}"
                        aria-current="{{ $isProjectsRoute ? 'page' : 'false' }}">Projects</a>
                    <a wire:navigate href="{{ route('welcome') }}#contact"
                        class="{{ $isHomeRoute ? $desktopActiveClass : $desktopInactiveClass }}"
                        data-nav-key="contact"
                        data-active-class="{{ $desktopActiveClass }}"
                        data-inactive-class="{{ $desktopInactiveClass }}"
                        aria-current="{{ $isHomeRoute ? 'page' : 'false' }}">Contact</a>
                    @auth
                        <a wire:navigate href="{{ route('dashboard') }}"
                            class="rounded-md px-3 py-2 font-medium {{ $isDashboardRoute ? 'bg-blue-500 text-white' : 'bg-blue-600 text-white hover:bg-blue-500' }}"
                            aria-current="{{ $isDashboardRoute ? 'page' : 'false' }}">Dashboard</a>
                    @endauth
                </div>
                <button id="menu-button" class="md:hidden rounded-md border border-gray-700 p-2 text-gray-200">
                    Menu
                </button>
            </div>
            <div id="mobile-menu" class="hidden pb-4 md:hidden">
                <div class="space-y-2 text-sm">
                    <a wire:navigate href="{{ route('welcome') }}"
                        class="block rounded px-2 py-1 {{ $isHomeRoute ? $mobileActiveClass : $mobileInactiveClass }}"
                        data-nav-key="home"
                        data-active-class="{{ $mobileActiveClass }}"
                        data-inactive-class="{{ $mobileInactiveClass }}"
                        aria-current="{{ $isHomeRoute ? 'page' : 'false' }}">Home</a>
                    <a wire:navigate href="{{ route('welcome') }}#about"
                        class="block rounded px-2 py-1 {{ $isHomeRoute ? $mobileActiveClass : $mobileInactiveClass }}"
                        data-nav-key="about"
                        data-active-class="{{ $mobileActiveClass }}"
                        data-inactive-class="{{ $mobileInactiveClass }}"
                        aria-current="{{ $isHomeRoute ? 'page' : 'false' }}">About</a>
                    <a wire:navigate href="{{ route('projects.index') }}"
                        class="block rounded px-2 py-1 {{ $isProjectsRoute ? $mobileActiveClass : $mobileInactiveClass }}"
                        data-nav-key="projects"
                        data-active-class="{{ $mobileActiveClass }}"
                        data-inactive-class="{{ $mobileInactiveClass }}"
                        aria-current="{{ $isProjectsRoute ? 'page' : 'false' }}">Projects</a>
                    <a wire:navigate href="{{ route('welcome') }}#contact"
                        class="block rounded px-2 py-1 {{ $isHomeRoute ? $mobileActiveClass : $mobileInactiveClass }}"
                        data-nav-key="contact"
                        data-active-class="{{ $mobileActiveClass }}"
                        data-inactive-class="{{ $mobileInactiveClass }}"
                        aria-current="{{ $isHomeRoute ? 'page' : 'false' }}">Contact</a>
                    @auth
                        <a wire:navigate href="{{ route('dashboard') }}"
                            class="block rounded px-2 py-1 {{ $isDashboardRoute ? 'bg-blue-500 text-white' : 'bg-blue-600 text-white hover:bg-blue-500' }}"
                            aria-current="{{ $isDashboardRoute ? 'page' : 'false' }}">Dashboard</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div id="content">{{ $slot }}</div>

    @include('layouts.footer')

    @livewireScripts
</body>

</html>
