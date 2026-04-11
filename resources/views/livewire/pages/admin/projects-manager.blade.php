<div>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <h2 class="font-semibold text-xl leading-tight text-slate-100">Projects Manager</h2>
            <a wire:navigate href="{{ route('admin.projects.create') }}" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-500">
                Add Project
            </a>
        </div>
    </x-slot>

    <div class="mx-auto max-w-7xl px-6 py-8">
        @if (session('success'))
            <div class="mb-4 rounded-md border border-emerald-500/40 bg-emerald-500/10 p-3 text-sm text-emerald-200">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid gap-3 rounded-xl border border-slate-700 bg-slate-900 p-4 shadow-sm md:grid-cols-4">
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search projects..." class="rounded-md border border-slate-700 bg-slate-950 px-3 py-2 text-slate-100">
            <select wire:model.live="status" class="rounded-md border border-slate-700 bg-slate-950 px-3 py-2 text-slate-100">
                <option value="all">All Status</option>
                <option value="published">Published</option>
                <option value="draft">Draft</option>
            </select>
            <select wire:model.live="featured" class="rounded-md border border-slate-700 bg-slate-950 px-3 py-2 text-slate-100">
                <option value="all">All Visibility</option>
                <option value="featured">Featured</option>
                <option value="normal">Normal</option>
            </select>
            <select wire:model.live="sort" class="rounded-md border border-slate-700 bg-slate-950 px-3 py-2 text-slate-100">
                <option value="latest">Newest</option>
                <option value="oldest">Oldest</option>
                <option value="title">Title A-Z</option>
            </select>
        </div>

        <div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($projects as $project)
                <article class="overflow-hidden rounded-xl border border-slate-700 bg-slate-900 shadow-sm">
                    @if (count($project->imageMedia()) > 0)
                        <img src="{{ asset('storage/'.$project->imageMedia()[0]) }}" alt="{{ $project->title }}" class="h-48 w-full object-cover">
                    @endif
                    <div class="p-4">
                        <div class="mb-2 flex flex-wrap gap-2 text-xs">
                            <span class="rounded px-2 py-0.5 {{ $project->is_published ? 'bg-green-500/20 text-green-300' : 'bg-yellow-500/20 text-yellow-300' }}">
                                {{ $project->is_published ? 'Published' : 'Draft' }}
                            </span>
                            <span class="rounded px-2 py-0.5 {{ $project->is_featured ? 'bg-sky-500/20 text-sky-300' : 'bg-slate-700 text-slate-300' }}">
                                {{ $project->is_featured ? 'Featured' : 'Standard' }}
                            </span>
                        </div>
                        <a wire:navigate href="{{ route('projects.show', $project) }}" class="text-xl font-semibold text-slate-100 hover:underline">{{ $project->title }}</a>
                        <p class="mt-2 line-clamp-3 text-sm text-slate-300">{{ $project->description }}</p>

                        <div class="mt-4 flex flex-wrap items-center gap-2 text-xs">
                            <button type="button" wire:click="togglePublished({{ $project->id }})" class="rounded border border-slate-600 px-2 py-1 text-slate-200 hover:bg-slate-800">
                                {{ $project->is_published ? 'Unpublish' : 'Publish' }}
                            </button>
                            <button type="button" wire:click="toggleFeatured({{ $project->id }})" class="rounded border border-slate-600 px-2 py-1 text-slate-200 hover:bg-slate-800">
                                {{ $project->is_featured ? 'Unfeature' : 'Feature' }}
                            </button>
                            <a wire:navigate href="{{ route('admin.projects.edit', $project) }}" class="text-sky-300 hover:text-sky-200">Edit</a>
                            <button type="button" wire:click="deleteProject({{ $project->id }})" wire:confirm="Delete this project?" class="text-red-300 hover:text-red-200">Delete</button>
                        </div>
                    </div>
                </article>
            @empty
                <p class="text-slate-400">No projects found.</p>
            @endforelse
        </div>

        <div class="mt-8">{{ $projects->links() }}</div>
    </div>
</div>
