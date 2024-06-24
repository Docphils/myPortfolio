<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Contact Messages') }}
        </h2>
    </x-slot>

    <div class="mt-8 w-2/3 mx-auto bg-gray-900 p-8 rounded-lg">
                
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 mb-4 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
        <a href="{{route('dashboard')}}" class="text-white bg-gray-700 shadow-md rounded-lg shadow-blue-500 p-3">Dashboard</a>
        
        <ul class="mt-3 shadow-lg px-3 divide-y divide-gray-700">
            @foreach($messages as $message)
                <li class="py-4">
                    <a href="{{ route('contacts.show', $message->id) }}" class="block bg-gray-800 text-lg text-gray-300 hover:bg-gray-70 hover:text-gray-50">{{ $message->name }}</a>
                    <p class="text-gray-300 line-clamp-1">{{ $message->message }}</p>
                    <p class=" text-blue-500">{{ $message->created_at->format('M d, Y H:i A') }}</p>
                </li>
            @endforeach
        </ul>
        
        {{ $messages->links() }} <!-- Pagination links -->
    </div>

</x-app-layout>