<footer class="relative mt-16 border-t border-slate-800 bg-slate-950/95">
    <div class="pointer-events-none absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-cyan-400/40 to-transparent"></div>
    <div class="mx-auto grid max-w-7xl gap-8 px-4 py-12 sm:px-6 lg:grid-cols-[1.2fr_0.8fr_0.8fr] lg:px-8">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-cyan-300">DocPhils</p>
            <h3 class="mt-3 text-xl font-semibold text-slate-100">Building products that perform and scale.</h3>
            <p class="mt-3 max-w-md text-sm text-slate-400">
                Fullstack development for business websites, web apps, and learning platforms with clean UX and reliable delivery.
            </p>
            <div class="mt-5 flex items-center gap-3">
                <a href="https://github.com/docphils" target="_blank" rel="noopener noreferrer" aria-label="GitHub"
                    class="inline-flex h-9 w-9 items-center justify-center rounded-md border border-slate-700 text-slate-300 transition hover:border-cyan-400 hover:text-cyan-300">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M12 .5a12 12 0 0 0-3.79 23.39c.6.11.82-.25.82-.57v-2.17c-3.34.73-4.04-1.41-4.04-1.41-.55-1.36-1.33-1.73-1.33-1.73-1.09-.73.08-.72.08-.72 1.2.08 1.84 1.21 1.84 1.21 1.07 1.8 2.8 1.28 3.49.98.11-.76.42-1.28.76-1.58-2.67-.3-5.47-1.31-5.47-5.84 0-1.29.47-2.35 1.23-3.18-.12-.3-.53-1.53.12-3.19 0 0 1.01-.32 3.3 1.21.96-.26 1.99-.39 3.01-.39s2.05.13 3.01.39c2.29-1.53 3.3-1.21 3.3-1.21.65 1.66.24 2.89.12 3.19.77.83 1.23 1.89 1.23 3.18 0 4.54-2.8 5.54-5.48 5.84.43.37.82 1.1.82 2.22v3.29c0 .31.22.68.83.57A12 12 0 0 0 12 .5Z" />
                    </svg>
                </a>
                <a href="https://www.linkedin.com/in/philip-nwachukwu/" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"
                    class="inline-flex h-9 w-9 items-center justify-center rounded-md border border-slate-700 text-slate-300 transition hover:border-cyan-400 hover:text-cyan-300">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M19 3H5a2 2 0 0 0-2 2v14c0 1.1.9 2 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2Zm-9.53 14.25H6.56V9h2.91v8.25ZM8.02 7.86a1.69 1.69 0 1 1 0-3.38 1.69 1.69 0 0 1 0 3.38Zm9.42 9.39h-2.91v-4.01c0-.96-.02-2.2-1.34-2.2-1.35 0-1.56 1.05-1.56 2.13v4.08H8.72V9h2.79v1.13h.04c.39-.74 1.34-1.52 2.77-1.52 2.96 0 3.51 1.95 3.51 4.48v4.16Z" />
                    </svg>
                </a>
            </div>
        </div>

        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-300">Explore</p>
            <nav class="mt-4 space-y-2 text-sm">
                <a wire:navigate href="{{ route('welcome') }}#about" class="block text-slate-300 transition hover:text-cyan-300">About</a>
                <a wire:navigate href="{{ route('projects.index') }}" class="block text-slate-300 transition hover:text-cyan-300">Projects</a>
                <a wire:navigate href="{{ route('welcome') }}#contact" class="block text-slate-300 transition hover:text-cyan-300">Contact</a>
            </nav>
        </div>

        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-300">Contact</p>
            <div class="mt-4 space-y-3 text-sm text-slate-300">
                <a href="tel:+2347062599737" class="block transition hover:text-cyan-300">
                    +234 (0) 706 259 9737
                </a>
                <a href="mailto:docphils64@gmail.com" class="block transition hover:text-cyan-300">
                    docphils64@gmail.com
                </a>
                <a href="mailto:philip@mephed.ng" class="block transition hover:text-cyan-300">
                    philip@mephed.ng
                </a>
            </div>
        </div>
    </div>

    <div class="border-t border-slate-800/80">
        <div class="mx-auto flex max-w-7xl flex-col items-start justify-between gap-2 px-4 py-4 text-xs text-slate-500 sm:px-6 md:flex-row md:items-center lg:px-8">
            <p>&copy; {{ now()->year }} DocPhils. All rights reserved.</p>
            <p>Built with Laravel + Livewire.</p>
        </div>
    </div>
</footer>
