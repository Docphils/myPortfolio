<main class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    @if (session('success'))
        <div class="mb-4 rounded-md border border-green-500/50 bg-green-500/20 p-3 text-sm text-green-200">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="text-3xl font-semibold">{{ $project->title }}</h1>
    <p class="mt-4 whitespace-pre-line text-gray-300">{{ $project->description }}</p>

    @if (count($project->imageMedia()) > 0)
        <div class="mt-8 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($project->imageMedia() as $image)
                <a href="{{ asset('storage/'.$image) }}" target="_blank">
                    <img src="{{ asset('storage/'.$image) }}" alt="{{ $project->title }}" class="h-52 w-full rounded-lg border border-gray-700 object-cover">
                </a>
            @endforeach
        </div>
    @endif

    @if ($project->link)
        <a href="{{ $project->link }}" target="_blank" class="mt-8 inline-flex rounded-md bg-blue-600 px-4 py-2 text-sm font-medium hover:bg-blue-500">
            Visit Project
        </a>
    @endif

    <div class="mt-6">
        <a href="{{ route('projects.index') }}" class="text-sm text-gray-300 underline">Back to projects</a>
    </div>
</main>
