<main>
    <section class="relative overflow-hidden bg-gray-950">
        <div class="absolute inset-0 bg-cover bg-center opacity-35" style="background-image: url('{{ asset('images/portfolioimage.jpg') }}');"></div>
        <div class="relative mx-auto max-w-7xl px-4 py-24 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 rounded-md border border-green-500/50 bg-green-500/20 p-3 text-sm text-green-200">
                    {{ session('success') }}
                </div>
            @endif
            <h1 class="text-4xl font-bold tracking-tight sm:text-5xl">Meet DocPhils</h1>
            <p class="mt-4 max-w-2xl text-lg text-gray-300">Fullstack Web Developer and EdTech Specialist.</p>
            <a href="#contact" class="mt-8 inline-flex rounded-md bg-blue-600 px-5 py-3 font-medium hover:bg-blue-500">Hire Me</a>
        </div>
    </section>

    <section id="about" class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-semibold">About Me</h2>
        @if ($about)
            <div class="mt-6 whitespace-pre-line text-gray-300">{{ $about->content }}</div>
        @else
            <p class="mt-6 text-gray-400">No content available.</p>
            @auth
                <a href="{{ route('abouts.create') }}" class="mt-4 inline-flex rounded-md bg-blue-600 px-4 py-2 text-sm font-medium hover:bg-blue-500">
                    Add About
                </a>
            @endauth
        @endif
    </section>

    <section id="projects" class="bg-gray-800/60">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-semibold">Projects</h2>
            <div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($projects as $project)
                    <article class="overflow-hidden rounded-xl border border-gray-700 bg-gray-900/80">
                        @if (count($project->imageMedia()) > 0)
                            <img src="{{ asset('storage/'.$project->imageMedia()[0]) }}" alt="{{ $project->title }}" class="h-48 w-full object-cover">
                        @endif
                        <div class="p-4">
                            <h3 class="text-xl font-semibold">{{ $project->title }}</h3>
                            <p class="mt-2 line-clamp-3 text-sm text-gray-300">{{ $project->description }}</p>
                        </div>
                    </article>
                @empty
                    <p class="text-gray-400">No projects available.</p>
                @endforelse
            </div>
            <a href="{{ route('projects.index') }}" class="mt-8 inline-flex rounded-md bg-gray-700 px-4 py-2 text-sm font-medium hover:bg-gray-600">
                More Projects
            </a>
        </div>
    </section>

    <section id="contact" class="mx-auto max-w-3xl px-4 py-16 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-semibold">Contact</h2>
        <p class="mt-3 text-gray-300">Feel free to reach out for collaboration opportunities.</p>
        <form wire:submit="submitContact" class="mt-8 space-y-4 rounded-xl border border-gray-700 bg-gray-900 p-6">
            <div>
                <label for="name" class="mb-1 block text-sm text-gray-300">Name</label>
                <input wire:model="name" id="name" type="text" class="w-full rounded-md border border-gray-700 bg-gray-800 px-3 py-2">
                @error('name') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="email" class="mb-1 block text-sm text-gray-300">Email</label>
                <input wire:model="email" id="email" type="email" class="w-full rounded-md border border-gray-700 bg-gray-800 px-3 py-2">
                @error('email') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="message" class="mb-1 block text-sm text-gray-300">Message</label>
                <textarea wire:model="message" id="message" rows="5" class="w-full rounded-md border border-gray-700 bg-gray-800 px-3 py-2"></textarea>
                @error('message') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
            </div>
            <button type="submit" class="inline-flex rounded-md bg-blue-600 px-5 py-2 font-medium hover:bg-blue-500">
                Send Message
            </button>
        </form>
    </section>
</main>
