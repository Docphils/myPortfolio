<main class="mx-auto max-w-5xl px-4 py-16 sm:px-6 lg:px-8">
    <a wire:navigate href="{{ route('welcome') }}" class="text-sm font-medium text-cyan-300 hover:text-cyan-200">Back to homepage</a>

    <article class="mt-6 overflow-hidden rounded-2xl border border-gray-700 bg-gray-900/90">
        @if ($caseStudy->cover_image)
            <img src="{{ asset('storage/'.$caseStudy->cover_image) }}" alt="{{ $caseStudy->title }}" class="h-72 w-full object-cover sm:h-96">
        @endif

        <div class="p-6 sm:p-8">
            <h1 class="text-3xl font-bold text-white">{{ $caseStudy->title }}</h1>
            @if ($caseStudy->excerpt)
                <p class="mt-3 text-gray-300">{{ $caseStudy->excerpt }}</p>
            @endif

            <div class="mt-8 grid gap-6 md:grid-cols-3">
                <section class="rounded-xl border border-gray-700 bg-gray-950/70 p-4">
                    <h2 class="text-sm font-semibold uppercase tracking-[0.18em] text-cyan-300">Challenge</h2>
                    <p class="mt-2 whitespace-pre-line text-sm text-gray-300">{{ $caseStudy->challenge ?: 'Not provided.' }}</p>
                </section>
                <section class="rounded-xl border border-gray-700 bg-gray-950/70 p-4">
                    <h2 class="text-sm font-semibold uppercase tracking-[0.18em] text-cyan-300">Solution</h2>
                    <p class="mt-2 whitespace-pre-line text-sm text-gray-300">{{ $caseStudy->solution ?: 'Not provided.' }}</p>
                </section>
                <section class="rounded-xl border border-gray-700 bg-gray-950/70 p-4">
                    <h2 class="text-sm font-semibold uppercase tracking-[0.18em] text-cyan-300">Results</h2>
                    <p class="mt-2 whitespace-pre-line text-sm text-gray-300">{{ $caseStudy->results ?: 'Not provided.' }}</p>
                </section>
            </div>

            @if ($caseStudy->project_url)
                <div class="mt-8">
                    <a href="{{ $caseStudy->project_url }}" target="_blank" class="inline-flex rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-500">
                        Visit Project
                    </a>
                </div>
            @endif
        </div>
    </article>
</main>
