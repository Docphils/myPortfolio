<div>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <h2 class="font-semibold text-xl leading-tight text-slate-100">Management Dashboard</h2>
            <a wire:navigate href="{{ route('welcome') }}"
                class="rounded-md border border-slate-600 px-3 py-2 text-sm text-slate-200 hover:bg-slate-800">
                View Public Site
            </a>
        </div>
    </x-slot>

    <div class="mx-auto max-w-7xl px-6 py-8">

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">
            <article class="rounded-xl border border-slate-700 bg-slate-900 p-5 shadow-sm">
                <p class="text-xs uppercase tracking-[0.2em] text-sky-300">Projects</p>
                <p class="mt-2 text-3xl font-bold text-slate-100">{{ $totalProjects }}</p>
                <p class="mt-1 text-sm text-slate-400">Published: {{ $publishedProjects }}</p>
            </article>
            <article class="rounded-xl border border-slate-700 bg-slate-900 p-5 shadow-sm">
                <p class="text-xs uppercase tracking-[0.2em] text-sky-300">Case Studies</p>
                <p class="mt-2 text-3xl font-bold text-slate-100">{{ $totalCaseStudies }}</p>
                <p class="mt-1 text-sm text-slate-400">Published: {{ $publishedCaseStudies }}</p>
            </article>
            <article class="rounded-xl border border-slate-700 bg-slate-900 p-5 shadow-sm">
                <p class="text-xs uppercase tracking-[0.2em] text-sky-300">Testimonials</p>
                <p class="mt-2 text-3xl font-bold text-slate-100">{{ $totalTestimonials }}</p>
                <p class="mt-1 text-sm text-slate-400">Published: {{ $publishedTestimonials }}</p>
            </article>
            <article class="rounded-xl border border-slate-700 bg-slate-900 p-5 shadow-sm">
                <p class="text-xs uppercase tracking-[0.2em] text-sky-300">Contacts</p>
                <p class="mt-2 text-3xl font-bold text-slate-100">{{ $totalMessages }}</p>
                <p class="mt-1 text-sm text-slate-400">Users: {{ $totalUsers }}</p>
            </article>
        </div>

        <section class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-3">
            <div class="rounded-xl border border-slate-700 bg-slate-900 p-5 shadow-sm">
                <h3 class="text-lg font-semibold text-slate-100">Projects Control</h3>
                <div class="mt-4 space-y-2">
                    <a wire:navigate href="{{ route('admin.projects.create') }}"
                        class="block rounded-md bg-blue-600 py-2 px-4 text-center text-sm font-medium text-white hover:bg-blue-500">Create
                        Project</a>
                    <a wire:navigate href="{{ route('admin.projects.index') }}"
                        class="block rounded-md bg-slate-700 py-2 px-4 text-center text-sm font-medium text-slate-100 hover:bg-slate-600">Manage
                        Projects</a>
                </div>
            </div>

            <div class="rounded-xl border border-slate-700 bg-slate-900 p-5 shadow-sm">
                <h3 class="text-lg font-semibold text-slate-100">Homepage CMS</h3>
                <div class="mt-4 space-y-2">
                    <a wire:navigate href="{{ route('admin.case-studies.index') }}"
                        class="block rounded-md bg-indigo-600 py-2 px-4 text-center text-sm font-medium text-white hover:bg-indigo-500">Manage
                        Case Studies</a>
                    <a wire:navigate href="{{ route('admin.testimonials.index') }}"
                        class="block rounded-md bg-blue-600 py-2 px-4 text-center text-sm font-medium text-white hover:bg-blue-500">Manage
                        Testimonials</a>
                </div>
            </div>

            <div class="rounded-xl border border-slate-700 bg-slate-900 p-5 shadow-sm">
                <h3 class="text-lg font-semibold text-slate-100">Profile & Inbox</h3>
                <div class="mt-4 space-y-2">
                    @if ($about)
                        <a wire:navigate href="{{ route('abouts.edit', $about) }}"
                            class="block rounded-md bg-slate-700 py-2 px-4 text-center text-sm font-medium text-slate-100 hover:bg-slate-600">Edit
                            About</a>
                    @else
                        <a wire:navigate href="{{ route('abouts.create') }}"
                            class="block rounded-md bg-green-600 py-2 px-4 text-center text-sm font-medium text-white hover:bg-green-500">Create
                            About</a>
                    @endif
                    <a wire:navigate href="{{ route('contacts.index') }}"
                        class="block rounded-md bg-red-600 py-2 px-4 text-center text-sm font-medium text-white hover:bg-red-500">Manage
                        Messages</a>
                </div>
            </div>
        </section>

        <section class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
            <div class="rounded-xl border border-slate-700 bg-slate-900 p-5 shadow-sm">
                <h3 class="text-lg font-semibold text-slate-100">Recent Contacts</h3>
                <div class="mt-4 space-y-3">
                    @forelse ($recentContacts as $contact)
                        <a wire:navigate href="{{ route('contacts.show', $contact) }}"
                            class="block rounded-md border border-slate-700 bg-slate-800 p-3 hover:border-sky-500/50">
                            <p class="font-medium text-slate-100">{{ $contact->name }}</p>
                            <p class="text-sm text-slate-300">{{ $contact->email }}</p>
                            <p class="mt-1 line-clamp-1 text-sm text-slate-400">{{ $contact->message }}</p>
                        </a>
                    @empty
                        <p class="text-sm text-slate-400">No contact messages yet.</p>
                    @endforelse
                </div>
            </div>

            <div class="rounded-xl border border-slate-700 bg-slate-900 p-5 shadow-sm">
                <h3 class="text-lg font-semibold text-slate-100">Recent Projects</h3>
                <div class="mt-4 space-y-3">
                    @forelse ($recentProjects as $project)
                        <a wire:navigate href="{{ route('projects.show', $project) }}"
                            class="block rounded-md border border-slate-700 bg-slate-800 p-3 hover:border-sky-500/50">
                            <div class="flex items-center justify-between gap-3">
                                <p class="font-medium text-slate-100">{{ $project->title }}</p>
                                <span
                                    class="rounded px-2 py-0.5 text-xs {{ $project->is_published ? 'bg-green-500/20 text-green-300' : 'bg-yellow-500/20 text-yellow-300' }}">
                                    {{ $project->is_published ? 'Published' : 'Draft' }}
                                </span>
                            </div>
                            <p class="mt-1 line-clamp-2 text-sm text-slate-400">{{ $project->description }}</p>
                        </a>
                    @empty
                        <p class="text-sm text-slate-400">No projects yet.</p>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
</div>
