<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-slate-100">
            {{ $about ? 'Edit About Me' : 'Add About Me' }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto px-6">
            <form wire:submit="save" class="rounded-lg bg-slate-900 p-6 shadow-sm border border-slate-700">
                <label for="content" class="block text-sm font-medium text-slate-300">Content</label>
                <textarea wire:model="content" id="content" rows="9" class="mt-2 w-full rounded-md border border-slate-700 bg-slate-950 text-slate-100"></textarea>
                @error('content')
                    <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                @enderror

                <div class="mt-6 flex flex-wrap gap-3">
                    <button type="submit" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-500">
                        {{ $about ? 'Update' : 'Save' }}
                    </button>
                    <a wire:navigate href="{{ route('dashboard') }}" class="rounded-md bg-slate-700 px-4 py-2 text-sm font-medium text-slate-100 hover:bg-slate-600">
                        Cancel
                    </a>
                    @if ($about)
                        <button
                            type="button"
                            wire:click="delete"
                            wire:confirm="Delete your About content?"
                            class="rounded-md bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-500"
                        >
                            Delete
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
