<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-200 dark:text-gray-200 leading-tight"> Add Projects </h2>
    </x-slot>

    <section class="py-16">
        <div class="container mx-auto px-6">
            <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-lg shadow-md">
                @method('PUT')
                @csrf
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
                {{-- Existing Media Preview --}}
                @if($project->media)
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Current Media</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                            @foreach(array_filter(explode(',', $project->media)) as $media)
                                @if(Str::endsWith($media, ['jpg','jpeg','png','gif']))
                                    <img src="{{ asset('storage/'.$media) }}" class="h-48 object-cover rounded">
                                @elseif(Str::endsWith($media, 'mp4'))
                                    <video controls class="h-32 rounded">
                                        <source src="{{ asset('storage/'.$media) }}" type="video/mp4">
                                    </video>
                                @endif
                            @endforeach

                        </div>
                    </div>
                @endif

                {{-- Upload New Media --}}
                <div class="mb-4">
                    <label for="media" class="block text-gray-700 font-bold">Replace Media</label>
                    <input type="file" name="media[]" id="media" class="w-full p-2 border border-gray-300 rounded mt-1" multiple>
                    @error('media')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="link" class="block text-gray-700 font-bold">Project Link</label>
                    <input type="url" name="link" id="link" class="w-full p-2 border border-gray-300 rounded mt-1" value="{{ old('title', $project->link) }}">
                    @error('link')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>               
                <div class="flex justify-between">
                    <button type="button" onclick="window.history.back();"  class="bg-yellow-500 text-white px-4 py-2 rounded">Cancel</button>
                    <button type="submit" class="bg-gray-900 text-white px-4 py-2 rounded">Create</button>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>