<div>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-3">
            <h2 class="font-semibold text-xl leading-tight text-slate-100">Case Studies Manager</h2>
            <a wire:navigate href="{{ route('dashboard') }}" class="rounded border border-slate-600 px-3 py-2 text-sm text-slate-200 hover:bg-slate-800">Back to Dashboard</a>
        </div>
    </x-slot>

    <div class="mx-auto max-w-7xl px-6 py-8">
        @if (session('success'))
            <div class="mb-4 rounded border border-emerald-500/40 bg-emerald-500/10 p-3 text-emerald-200">{{ session('success') }}</div>
        @endif

        <div class="grid gap-6 lg:grid-cols-[1.2fr_0.8fr]">
            <form wire:submit="save" class="rounded-lg border border-slate-700 bg-slate-900 p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-slate-100">{{ $editingId ? 'Edit' : 'Create' }} Case Study</h3>
                <div class="mt-4 grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="text-sm text-slate-300">Title</label>
                        <input wire:model="title" class="mt-1 w-full rounded border border-slate-700 bg-slate-950 text-slate-100">
                        @error('title') <p class="text-xs text-red-300">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="text-sm text-slate-300">Slug</label>
                        <input wire:model="slug" class="mt-1 w-full rounded border border-slate-700 bg-slate-950 text-slate-100">
                        @error('slug') <p class="text-xs text-red-300">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div class="mt-4">
                    <label class="text-sm text-slate-300">Linked Project</label>
                    <select wire:model="project_id" class="mt-1 w-full rounded border border-slate-700 bg-slate-950 text-slate-100">
                        <option value="">None</option>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-4">
                    <label class="text-sm text-slate-300">Excerpt</label>
                    <textarea wire:model="excerpt" rows="3" class="mt-1 w-full rounded border border-slate-700 bg-slate-950 text-slate-100"></textarea>
                </div>
                <div class="mt-4 grid gap-4 sm:grid-cols-3">
                    <div>
                        <label class="text-sm text-slate-300">Sort Order</label>
                        <input wire:model="sort_order" type="number" min="0" class="mt-1 w-full rounded border border-slate-700 bg-slate-950 text-slate-100">
                    </div>
                    <div>
                        <label class="text-sm text-slate-300">Published At</label>
                        <input wire:model="published_at" type="datetime-local" class="mt-1 w-full rounded border border-slate-700 bg-slate-950 text-slate-100">
                    </div>
                    <div>
                        <label class="text-sm text-slate-300">Live URL</label>
                        <input wire:model="project_url" type="url" class="mt-1 w-full rounded border border-slate-700 bg-slate-950 text-slate-100">
                    </div>
                </div>
                <div class="mt-4">
                    <label class="text-sm text-slate-300">Stack (comma separated)</label>
                    <input wire:model="stack_input" class="mt-1 w-full rounded border border-slate-700 bg-slate-950 text-slate-100">
                </div>
                <div class="mt-4">
                    <label class="text-sm text-slate-300">Cover Image</label>
                    <input wire:model="cover_image" type="file" class="mt-1 w-full rounded border border-slate-700 bg-slate-950 text-slate-200">
                    @if ($current_cover_image)
                        <img src="{{ asset('storage/'.$current_cover_image) }}" class="mt-3 h-24 rounded object-cover">
                    @endif
                </div>
                <div class="mt-4 grid gap-4 sm:grid-cols-3">
                    <div>
                        <label class="text-sm text-slate-300">Challenge</label>
                        <textarea wire:model="challenge" rows="4" class="mt-1 w-full rounded border border-slate-700 bg-slate-950 text-slate-100"></textarea>
                    </div>
                    <div>
                        <label class="text-sm text-slate-300">Solution</label>
                        <textarea wire:model="solution" rows="4" class="mt-1 w-full rounded border border-slate-700 bg-slate-950 text-slate-100"></textarea>
                    </div>
                    <div>
                        <label class="text-sm text-slate-300">Results</label>
                        <textarea wire:model="results" rows="4" class="mt-1 w-full rounded border border-slate-700 bg-slate-950 text-slate-100"></textarea>
                    </div>
                </div>
                <label class="mt-4 inline-flex items-center gap-2 text-sm text-slate-300">
                    <input wire:model="is_published" type="checkbox"> Published
                </label>
                <div class="mt-6 flex gap-2">
                    <button class="rounded bg-blue-600 px-4 py-2 text-sm text-white">{{ $editingId ? 'Update' : 'Create' }}</button>
                    <button type="button" wire:click="resetForm" class="rounded bg-slate-700 px-4 py-2 text-sm text-slate-100">Reset</button>
                </div>
            </form>

            <div class="rounded-lg border border-slate-700 bg-slate-900 p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-slate-100">Library</h3>
                <div class="mt-3 grid gap-2">
                    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search case studies..." class="rounded border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-slate-100">
                    <select wire:model.live="status" class="rounded border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-slate-100">
                        <option value="all">All Status</option>
                        <option value="published">Published</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>
                <div class="mt-4 space-y-3">
                    @forelse ($caseStudies as $item)
                        <div class="rounded border border-slate-700 bg-slate-800 p-3">
                            <div class="flex items-center justify-between gap-2">
                                <p class="font-semibold text-slate-100">{{ $item->title }}</p>
                                <span class="rounded px-2 py-0.5 text-xs {{ $item->is_published ? 'bg-green-500/20 text-green-300' : 'bg-yellow-500/20 text-yellow-300' }}">
                                    {{ $item->is_published ? 'Published' : 'Draft' }}
                                </span>
                            </div>
                            <p class="text-xs text-slate-400">{{ $item->slug }}</p>
                            <div class="mt-2 flex flex-wrap gap-3 text-sm">
                                <button type="button" wire:click="edit({{ $item->id }})" class="text-sky-300">Edit</button>
                                <button type="button" wire:click="togglePublished({{ $item->id }})" class="text-cyan-300">
                                    {{ $item->is_published ? 'Unpublish' : 'Publish' }}
                                </button>
                                <button type="button" wire:click="delete({{ $item->id }})" wire:confirm="Delete this case study?" class="text-red-300">Delete</button>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-slate-400">No case studies yet.</p>
                    @endforelse
                </div>
                <div class="mt-4">
                    {{ $caseStudies->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
