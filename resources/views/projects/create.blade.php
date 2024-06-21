<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"> Add Projects </h2>
    </x-slot>

    <section class="py-16">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-center mb-8">Create Project</h2>
            <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-lg shadow-md">
                @csrf
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-bold">Title</label>
                    <input type="text" name="title" id="title" class="w-full p-2 border border-gray-300 rounded mt-1" value="{{ old('title') }}">
                    @error('title')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-bold">Description</label>
                    <textarea name="description" id="description" class="w-full p-2 border border-gray-300 rounded mt-1">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="media" class="block text-gray-700 font-bold">Media (Images or Videos - Select Multiple)</label>
                    <input type="file" name="media[]" id="media" class="w-full p-2 border border-gray-300 rounded mt-1" multiple>
                    @error('media')
                      <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>                  
                <div class="text-center">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create</button>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>