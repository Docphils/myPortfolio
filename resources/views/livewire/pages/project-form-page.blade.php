<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ $project ? 'Edit Project' : 'Create Project' }}
        </h2>
    </x-slot>

    <section class="py-10">
        <div class="container mx-auto px-6">
            <form wire:submit="save" class="rounded-lg bg-white p-8 shadow-md">
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-bold">Title</label>
                    <input wire:model="title" type="text" id="title" class="mt-1 w-full rounded border border-gray-300 p-2">
                    @error('title') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-bold">Description</label>
                    <textarea wire:model="description" id="description" rows="6" class="mt-1 w-full rounded border border-gray-300 p-2"></textarea>
                    @error('description') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="media" class="block text-gray-700 font-bold">{{ $project ? 'Replace Media' : 'Media Files' }}</label>
                    <input wire:model="media" type="file" id="media" class="mt-1 w-full rounded border border-gray-300 p-2" multiple>
                    @error('media') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    @error('media.*') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                @if ($project && count($project->mediaItems()) > 0)
                    <div class="mb-4">
                        <p class="mb-2 block text-gray-700 font-bold">Current Media</p>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                            @foreach ($project->imageMedia() as $image)
                                <img src="{{ asset('storage/'.$image) }}" class="h-32 rounded object-cover">
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="mb-4">
                    <label for="link" class="block text-gray-700 font-bold">Project Link</label>
                    <input wire:model="link" type="url" id="link" class="mt-1 w-full rounded border border-gray-300 p-2">
                    @error('link') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-between">
                    <a href="{{ route('projects.index') }}" class="rounded bg-yellow-500 px-4 py-2 text-white">Cancel</a>
                    <button type="submit" class="rounded bg-gray-900 px-4 py-2 text-white">
                        {{ $project ? 'Update' : 'Create' }}
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>
