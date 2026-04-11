<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-slate-100">
            Contact Message
        </h2>
    </x-slot>

    <div class="mt-8 max-w-xl mx-auto rounded-lg bg-slate-900 p-8 shadow-sm border border-slate-700">
        <h1 class="text-3xl font-bold text-slate-100">{{ $contact->name }}</h1>
        <p class="mt-2 text-sm text-slate-400">{{ $contact->created_at->format('M d, Y H:i A') }}</p>
        <p class="mt-4 text-sky-300">Email: {{ $contact->email }}</p>
        <p class="mt-4 whitespace-pre-line text-slate-200">{{ $contact->message }}</p>
        <div class="mt-6 flex items-center justify-between">
            <a wire:navigate href="{{ route('contacts.index') }}" class="text-sky-300 hover:text-sky-200">Back to messages</a>
            <button type="button" wire:click="delete" wire:confirm="Delete this contact message?" class="rounded bg-red-600 px-3 py-1 text-sm text-white hover:bg-red-500">
                Delete
            </button>
        </div>
    </div>
</div>
