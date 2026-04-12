<main class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    @if (session('success'))
        <div class="mb-4 rounded-md border border-green-500/50 bg-green-500/20 p-3 text-sm text-green-200">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="text-3xl font-semibold">{{ $project->title }}</h1>
    <p class="mt-4 whitespace-pre-line text-gray-300">{{ $project->description }}</p>

    @php
        $images = $project->imageMedia();
    @endphp

    @if (count($images) > 0)
        <div x-data="{ open: false, index: 0, images: @js(array_map(static fn ($image) => asset('storage/' . $image), $images)), show(i) { this.index = i; this.open = true; }, next() { this.index = (this.index + 1) % this.images.length; }, prev() { this.index = (this.index - 1 + this.images.length) % this.images.length; } }">
            <div class="mt-8 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($images as $index => $image)
                    <button type="button" x-on:click="show({{ $index }})">
                        <img src="{{ asset('storage/' . $image) }}" alt="{{ $project->title }}"
                            class="h-52 w-full rounded-lg border border-gray-700 object-cover">
                    </button>
                @endforeach
            </div>

            <div x-show="open" x-transition.opacity x-on:keydown.escape.window="open = false"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4" style="display: none;">
                <button type="button" x-on:click="open = false"
                    class="absolute right-4 top-4 rounded bg-slate-900/90 px-3 py-1 text-lg text-white">x</button>

                <div class="relative w-full max-w-5xl">
                    <img :src="images[index]" alt="{{ $project->title }}" class="max-h-[85vh] w-full rounded object-contain">
                    <button type="button" x-show="images.length > 1" x-on:click="prev()"
                        class="absolute left-2 top-1/2 -translate-y-1/2 rounded bg-slate-900/90 px-3 py-2 text-white">
                        Prev
                    </button>
                    <button type="button" x-show="images.length > 1" x-on:click="next()"
                        class="absolute right-2 top-1/2 -translate-y-1/2 rounded bg-slate-900/90 px-3 py-2 text-white">
                        Next
                    </button>
                </div>
            </div>
        </div>
    @endif

    @if (count($project->videoMedia()) > 0)
        <div class="mt-8 space-y-4">
            @foreach ($project->videoMedia() as $video)
                <video controls class="w-full rounded-lg border border-gray-700 bg-black">
                    <source src="{{ asset('storage/' . $video) }}" type="video/mp4">
                </video>
            @endforeach
        </div>
    @endif

    @if ($project->link)
        <a href="{{ $project->link }}" target="_blank" class="mt-8 inline-flex rounded-md bg-blue-600 px-4 py-2 text-sm font-medium hover:bg-blue-500">
            Visit Project
        </a>
    @endif

    <div class="mt-6">
        <a wire:navigate href="{{ route('projects.index') }}" class="text-sm text-gray-300 underline">Back to projects</a>
    </div>
</main>
