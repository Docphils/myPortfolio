<main class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    <div class="flex flex-wrap items-center justify-between gap-3">
        <h1 class="text-3xl font-semibold">Projects</h1>
        @auth
            <a wire:navigate href="{{ route('admin.projects.index') }}" class="rounded-md border border-gray-600 px-4 py-2 text-sm font-medium text-gray-100 hover:bg-gray-800">
                Open Project Manager
            </a>
        @endauth
    </div>

    <div class="mt-6">
        <input
            type="text"
            wire:model.live.debounce.300ms="search"
            placeholder="Search published projects..."
            class="w-full rounded-md border border-gray-700 bg-gray-800 px-3 py-2 md:max-w-md"
        >
    </div>

    <div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($projects as $project)
            <article class="overflow-hidden rounded-xl border border-gray-700 bg-gray-900">
                @if (count($project->imageMedia()) > 0)
                    <img src="{{ asset('storage/'.$project->imageMedia()[0]) }}" alt="{{ $project->title }}" class="h-48 w-full object-cover">
                @endif
                <div class="p-4">
                    <a wire:navigate href="{{ route('projects.show', $project) }}" class="text-xl font-semibold underline">{{ $project->title }}</a>
                    <p class="mt-2 line-clamp-3 text-sm text-gray-300">{{ $project->description }}</p>
                    <div class="mt-4">
                        <a href="{{ $project->link ?: route('projects.show', $project) }}" target="_blank" class="rounded bg-blue-600 px-3 py-1 text-xs font-medium hover:bg-blue-500">
                            Visit
                        </a>
                    </div>
                </div>
            </article>
        @empty
            <p class="text-gray-400">No projects found.</p>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $projects->links() }}
    </div>
</main>
