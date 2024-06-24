<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Contact Message') }}
        </h2>
    </x-slot>

    <div class="mt-8 max-w-xl mx-auto bg-gray-900 p-8 rounded-lg">
        <h1 class="text-3xl font-bold text-white mb-4">{{ $message->name }}</h1>
        <p class="text-gray-300 mb-4">{{ $message->created_at->format('M d, Y H:i A') }}</p>
        <p class="text-gray-100">{{ $message->message }}</p>
        <a href="{{ route('contacts.index') }}" class="block mt-4 text-blue-500 hover:text-blue-600">&larr; Back to Messages</a>
    </div>

</x-app-layout>