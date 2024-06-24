<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-16 px-6">
    
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    
            <!-- Projects Card -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center">
                        <svg class="w-12 h-12 text-blue-500 mr-4" fill="currentColor" viewBox="0 0 20 20"><path d="M2 4a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V4zm10 1H8v4h4V5z"></path></svg>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-700">Projects</h2>
                            <p class="text-gray-600">Total Projects: {{ $totalProjects }}</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('projects.create') }}" class="block bg-blue-500 text-white py-2 px-4 rounded-lg text-center hover:bg-blue-600">Add New Project</a>
                        <a href="{{ route('projects.index') }}" class="block bg-gray-500 text-white py-2 px-4 rounded-lg text-center mt-2 hover:bg-gray-600">View All Projects</a>
                    </div>
                </div>
            </div>
    
            <!-- About Card -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center">
                        <svg class="w-12 h-12 text-green-500 mr-4" fill="currentColor" viewBox="0 0 20 20"><path d="M4 3a1 1 0 00-1 1v1h14V4a1 1 0 00-1-1H4zm14 3H2v10a2 2 0 002 2h12a2 2 0 002-2V6zm-9 4H7v5h2v-5zm4 0h-2v5h2v-5z"></path></svg>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-700">About</h2>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('abouts.create') }}" class="block bg-green-500 text-white py-2 px-4 rounded-lg text-center hover:bg-green-600">Add About Info</a>
                        <a href="{{ route('abouts.edit', 1) }}" class="block bg-gray-500 text-white py-2 px-4 rounded-lg text-center mt-2 hover:bg-gray-600">Edit About Info</a>
                    </div>
                </div>
            </div>
    
            <!-- Contact Card -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center">
                        <svg class="w-12 h-12 text-red-500 mr-4" fill="currentColor" viewBox="0 0 20 20"><path d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5zm12 1H6v2h8V6zm0 4H6v2h8v-2z"></path></svg>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-700">Contact</h2>
                            <p class="text-gray-600">Total Messages: {{ $totalMessages }}</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('contacts.index') }}" class="block bg-red-500 text-white py-2 px-4 rounded-lg text-center hover:bg-red-600">View All Messages</a>
                    </div>
                </div>
            </div>
    
        </div>
    </div>
</x-app-layout>
