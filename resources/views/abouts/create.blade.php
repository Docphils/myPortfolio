<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-200 dark:text-gray-200 leading-tight"> Add About Me </h2>
    </x-slot>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-300 dark:text-gray-100">
            <section id="about" class="py-16 bg-gray-900">
              <div class="container mx-auto px-6">
                <form action="{{ route('abouts.store') }}" method="POST" class="mt-8 max-w-3xl mx-auto">
                  @csrf
                  <textarea name="content" class="w-full bg-gray-800 text-gray-300 p-4 rounded @error('content') border border-red-500 @enderror" rows="6"></textarea>
                  @error('content')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                  @enderror
                  <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Save</button>
                </form>
              </div>
            </section>
          </div>
        </div>
      </div>
    </div>
  </x-app-layout>