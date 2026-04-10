<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            Contact Messages
        </h2>
    </x-slot>

    <div class="mt-8 w-full max-w-4xl mx-auto rounded-lg bg-gray-900 p-8">
        @if (session('success'))
            <div class="mb-4 rounded-md border border-green-500/40 bg-green-500/20 p-3 text-green-200">
                {{ session('success') }}
            </div>
        @endif

        <ul class="divide-y divide-gray-700">
            @forelse ($messages as $message)
                <li class="py-4">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <a href="{{ route('contacts.show', $message) }}" class="text-lg text-gray-200 hover:text-white">
                                {{ $message->name }}
                            </a>
                            <p class="line-clamp-1 text-sm text-gray-400">{{ $message->message }}</p>
                            <p class="text-xs text-blue-400">{{ $message->created_at->format('M d, Y H:i A') }}</p>
                        </div>
                        <button type="button" wire:click="deleteMessage({{ $message->id }})" class="text-sm text-red-300 hover:text-red-200">
                            Delete
                        </button>
                    </div>
                </li>
            @empty
                <li class="py-4 text-gray-400">No messages yet.</li>
            @endforelse
        </ul>

        <div class="mt-4">
            {{ $messages->links() }}
        </div>
    </div>
</x-app-layout>
