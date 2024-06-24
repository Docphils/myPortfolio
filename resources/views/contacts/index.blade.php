<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Contact Messages') }}
        </h2>
    </x-slot>

    <div class="mt-8 max-w-xl mx-auto bg-gray-900 p-8 rounded-lg">
                
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 mb-4 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
        
        <ul class="divide-y divide-gray-700">
            @foreach($messages as $message)
                <li class="py-4">
                    <a href="{{ route('contacts.show', $message->id) }}" class="block text-blue-500 hover:text-blue-600">{{ $message->name }}</a>
                    <p class="text-gray-300">{{ $message->created_at->format('M d, Y H:i A') }}</p>
                </li>
            @endforeach
        </ul>
        
        {{ $messages->links() }} <!-- Pagination links -->
    </div>

</x-app-layout>