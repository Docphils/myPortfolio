<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-slate-100">Contact Messages</h2>
    </x-slot>

    <div class="mx-auto mt-8 w-full max-w-5xl rounded-lg border border-slate-700 bg-slate-900 p-8 shadow-sm">

        <div class="grid gap-3 rounded-xl border border-slate-700 bg-slate-800 p-4 md:grid-cols-4">
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search messages..." class="rounded border border-slate-600 bg-slate-900 px-3 py-2 text-sm text-slate-100">
            <input wire:model.live="dateFrom" type="date" class="rounded border border-slate-600 bg-slate-900 px-3 py-2 text-sm text-slate-100">
            <input wire:model.live="dateTo" type="date" class="rounded border border-slate-600 bg-slate-900 px-3 py-2 text-sm text-slate-100">
            <button type="button" wire:click="clearFilters" class="rounded bg-slate-700 px-3 py-2 text-sm text-slate-100 hover:bg-slate-600">Clear Filters</button>
        </div>

        <ul class="mt-4 divide-y divide-slate-700">
            @forelse ($messages as $message)
                <li class="py-4">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <a wire:navigate href="{{ route('contacts.show', $message) }}" class="text-lg text-slate-100 hover:text-sky-300">
                                {{ $message->name }}
                            </a>
                            <p class="text-sm text-sky-300">{{ $message->email }}</p>
                            <p class="line-clamp-1 text-sm text-slate-300">{{ $message->message }}</p>
                            <p class="text-xs text-slate-400">{{ $message->created_at->format('M d, Y H:i A') }}</p>
                        </div>
                        <button type="button" wire:click="deleteMessage({{ $message->id }})" wire:confirm="Delete this contact message?" class="rounded border border-red-500/40 px-3 py-1 text-xs text-red-300 hover:bg-red-500/10">
                            Delete
                        </button>
                    </div>
                </li>
            @empty
                <li class="py-6 text-center text-slate-400">No messages found.</li>
            @endforelse
        </ul>

        <div class="mt-4">
            {{ $messages->links() }}
        </div>
    </div>
</div>
