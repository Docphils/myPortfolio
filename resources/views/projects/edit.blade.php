<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"> Add Projects </h2>
    </x-slot>
    <section class="py-16">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-center mb-8">Edit Project</h2>
            <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-lg shadow-md">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-bold">Title</label>
                    <input type="text" name="title" id="title" class="w-full p-2 border border-gray-300 rounded mt-1" value="{{ old('title', $project->title) }}">
                    @error('title')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-bold">Description</label>
                    <textarea name="description" id="description" class="w-full p-2 border border-gray-300 rounded mt-1">{{ old('description', $project->description) }}</textarea>
                    @error('description')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="media" class="block text-gray-700 font-bold">Media (Image or Video)</label>
                    <input type="file" name="media" id="media" class="w-full p-2 border border-gray-300 rounded mt-1">
                    @error('media')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="text-center">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>