<div>
    <section class="py-10">
        <div class="container mx-auto px-6">
            <div class="mb-6 flex items-center justify-between">
                <h2 class="text-2xl font-semibold text-slate-100">{{ $project ? 'Edit Project' : 'Create Project' }}</h2>
                <a wire:navigate href="{{ route('admin.projects.index') }}"
                    class="rounded border border-slate-600 px-3 py-2 text-sm text-slate-200 hover:bg-slate-800">Back to
                    Manager</a>
            </div>
            <form wire:submit="save"
                class="rounded-lg bg-slate-900 p-8 shadow-md w-full max-w-3xl mx-auto border border-slate-700">
                <div class="mb-4">
                    <label for="title" class="block text-slate-300 font-bold">Title</label>
                    <input wire:model="title" type="text" id="title"
                        class="mt-1 w-full rounded border border-slate-700 bg-slate-950 p-2 text-slate-100">
                    @error('title')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-slate-300 font-bold">Description</label>
                    <textarea wire:model="description" id="description" rows="6"
                        class="mt-1 w-full rounded border border-slate-700 bg-slate-950 p-2 text-slate-100"></textarea>
                    @error('description')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="media"
                        class="block text-slate-300 font-bold">{{ $project ? 'Replace Media' : 'Media Files' }}</label>
                    <input wire:model="media" type="file" id="media"
                        class="mt-1 w-full rounded border border-slate-700 bg-slate-950 p-2 text-slate-200" multiple>
                    @error('media')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                    @error('media.*')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                @if ($project && count($project->mediaItems()) > 0)
                    <div class="mb-4">
                        <p class="mb-2 block text-slate-300 font-bold">Current Media</p>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                            @foreach ($project->imageMedia() as $image)
                                <img src="{{ asset('storage/' . $image) }}" class="h-32 rounded object-cover">
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="mb-4">
                    <label for="link" class="block text-slate-300 font-bold">Project Link</label>
                    <input wire:model="link" type="url" id="link"
                        class="mt-1 w-full rounded border border-slate-700 bg-slate-950 p-2 text-slate-100">
                    @error('link')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4 grid gap-4 sm:grid-cols-3">
                    <div>
                        <label class="text-slate-300 font-bold">Published At</label>
                        <input wire:model="published_at" type="datetime-local"
                            class="mt-1 w-full rounded border border-slate-700 bg-slate-950 p-2 text-slate-100">
                        @error('published_at')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <label class="mt-8 inline-flex items-center gap-2 text-slate-300 font-semibold">
                        <input wire:model="is_published" type="checkbox"> Published
                    </label>
                    <label class="mt-8 inline-flex items-center gap-2 text-slate-300 font-semibold">
                        <input wire:model="is_featured" type="checkbox"> Featured
                    </label>
                </div>

                <div class="flex justify-between">
                    <a wire:navigate href="{{ route('admin.projects.index') }}"
                        class="rounded bg-slate-700 px-4 py-2 text-slate-100 hover:bg-slate-600">Cancel</a>
                    <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-500">
                        {{ $project ? 'Update' : 'Create' }}
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>
