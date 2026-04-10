<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            Contact Message
        </h2>
    </x-slot>

    <div class="mt-8 max-w-xl mx-auto rounded-lg bg-gray-900 p-8 shadow-lg">
        <h1 class="text-3xl font-bold text-white">{{ $contact->name }}</h1>
        <p class="mt-2 text-sm text-gray-400">{{ $contact->created_at->format('M d, Y H:i A') }}</p>
        <p class="mt-4 text-red-400">Email: {{ $contact->email }}</p>
        <p class="mt-4 whitespace-pre-line text-gray-100">{{ $contact->message }}</p>
        <div class="mt-6 flex items-center justify-between">
            <a href="{{ route('contacts.index') }}" class="text-blue-400 hover:text-blue-300">Back to messages</a>
            <button type="button" wire:click="delete" class="rounded bg-red-600 px-3 py-1 text-sm text-white hover:bg-red-500">
                Delete
            </button>
        </div>
    </div>
</x-app-layout>
