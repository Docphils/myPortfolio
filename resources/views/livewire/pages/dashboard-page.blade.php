<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="container mx-auto py-10 px-6">
        @if (session('success'))
            <div class="mb-6 rounded-md border border-green-500/40 bg-green-500/20 p-3 text-green-200">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            <div class="rounded-lg bg-white p-6 shadow-md">
                <h3 class="text-2xl font-bold text-gray-700">Projects</h3>
                <p class="mt-1 text-gray-600">Total Projects: {{ $totalProjects }}</p>
                <div class="mt-4 space-y-2">
                    <a href="{{ route('projects.create') }}" class="block rounded-md bg-blue-500 py-2 px-4 text-center text-white hover:bg-blue-600">Add New Project</a>
                    <a href="{{ route('projects.index') }}" class="block rounded-md bg-gray-700 py-2 px-4 text-center text-white hover:bg-gray-800">View All Projects</a>
                </div>
            </div>

            <div class="rounded-lg bg-white p-6 shadow-md">
                <h3 class="text-2xl font-bold text-gray-700">About</h3>
                <p class="mt-1 text-gray-600">{{ $about ? 'Profile configured' : 'No profile content yet' }}</p>
                <div class="mt-4 space-y-2">
                    @if ($about)
                        <a href="{{ route('abouts.edit', $about) }}" class="block rounded-md bg-gray-700 py-2 px-4 text-center text-white hover:bg-gray-800">Edit About Info</a>
                    @else
                        <a href="{{ route('abouts.create') }}" class="block rounded-md bg-green-500 py-2 px-4 text-center text-white hover:bg-green-600">Add About Info</a>
                    @endif
                </div>
            </div>

            <div class="rounded-lg bg-white p-6 shadow-md">
                <h3 class="text-2xl font-bold text-gray-700">Contacts</h3>
                <p class="mt-1 text-gray-600">Total Messages: {{ $totalMessages }}</p>
                <p class="text-gray-600">Total Users: {{ $totalUsers }}</p>
                <div class="mt-4">
                    <a href="{{ route('contacts.index') }}" class="block rounded-md bg-red-500 py-2 px-4 text-center text-white hover:bg-red-600">View All Messages</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
