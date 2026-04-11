<main class="homepage-shell">
    <section class="hero-aurora relative overflow-hidden">
        <div class="pointer-events-none absolute inset-0 z-0 bg-cover bg-center opacity-30 hero-parallax" style="background-image: url('{{ asset('images/portfolioimage.jpg') }}');"></div>
        <div class="pointer-events-none absolute -top-12 left-0 h-64 w-64 rounded-full bg-cyan-400/20 blur-3xl float-slow"></div>
        <div class="pointer-events-none absolute -bottom-10 right-5 h-72 w-72 rounded-full bg-blue-500/20 blur-3xl float-delay"></div>

        <div class="relative z-10 mx-auto grid max-w-7xl gap-10 px-4 py-24 sm:px-6 lg:grid-cols-2 lg:items-center lg:px-8">
            <div data-animate>
                @if (session('success'))
                    <div class="mb-4 rounded-md border border-green-500/50 bg-green-500/20 p-3 text-sm text-green-200">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="mb-4 rounded-md border border-red-500/50 bg-red-500/20 p-3 text-sm text-red-200">
                        {{ session('error') }}
                    </div>
                @endif

                <p class="inline-flex rounded-full border border-cyan-300/40 bg-cyan-400/10 px-3 py-1 text-xs font-medium uppercase tracking-[0.2em] text-cyan-100">
                    Fullstack Developer | EdTech Specialist
                </p>
                <h1 class="mt-5 text-4xl font-bold tracking-tight text-white sm:text-5xl lg:text-6xl">
                    Building Products That Teach, Scale, and Win Users
                </h1>
                <p class="mt-5 max-w-xl text-base text-gray-200 sm:text-lg">
                    I craft high-performance web products, learning platforms, and growth-ready systems with Laravel, Livewire, and thoughtful UX execution.
                </p>
                <div class="mt-8 flex flex-wrap items-center gap-3">
                    <button type="button" wire:click="openProjectStarter" class="inline-flex rounded-md bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:-translate-y-0.5 hover:bg-blue-500">
                        Start a Project
                    </button>
                    @if ($caseStudies->isNotEmpty())
                        <button type="button" wire:click="openCaseStudies" class="inline-flex rounded-md border border-white/30 bg-white/10 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/20">
                            Open Latest Case Study
                        </button>
                    @endif
                </div>
            </div>

            <div class="grid gap-4 sm:grid-cols-3" data-animate>
                <article class="rounded-2xl border border-white/20 bg-white/10 p-5 backdrop-blur-md card-lift">
                    <p class="text-3xl font-bold text-white"><span data-counter="{{ $yearsExperience }}">0</span>+</p>
                    <p class="mt-1 text-sm text-gray-200">Years Building</p>
                </article>
                <article class="rounded-2xl border border-white/20 bg-white/10 p-5 backdrop-blur-md card-lift">
                    <p class="text-3xl font-bold text-white"><span data-counter="{{ $totalProjects }}">0</span>+</p>
                    <p class="mt-1 text-sm text-gray-200">Projects Delivered</p>
                </article>
                <article class="rounded-2xl border border-white/20 bg-white/10 p-5 backdrop-blur-md card-lift">
                    <p class="text-3xl font-bold text-white"><span data-counter="{{ $totalMessages }}">0</span>+</p>
                    <p class="mt-1 text-sm text-gray-200">Client Conversations</p>
                </article>
            </div>
        </div>
    </section>

    @if ($showProjectStarter)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 px-4" wire:key="project-starter-modal">
            <div class="w-full max-w-2xl rounded-2xl border border-gray-700 bg-gray-900 p-6 shadow-2xl">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h2 class="text-2xl font-semibold text-white">Project Starter</h2>
                        <p class="mt-1 text-sm text-gray-300">Share your details and project brief to submit directly from here.</p>
                    </div>
                    <button type="button" wire:click="closeProjectStarter" class="rounded bg-gray-800 px-3 py-1 text-sm text-gray-200 hover:bg-gray-700">Close</button>
                </div>

                <form wire:submit="submitProjectStarter" class="mt-5 space-y-4">
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="mb-1 block text-sm text-gray-300">Name</label>
                            <input wire:model="name" type="text" class="w-full rounded-md border border-gray-700 bg-gray-800 px-3 py-2 text-white">
                            @error('name') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="mb-1 block text-sm text-gray-300">Email</label>
                            <input wire:model="email" type="email" class="w-full rounded-md border border-gray-700 bg-gray-800 px-3 py-2 text-white">
                            @error('email') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-3">
                        <div>
                            <label class="mb-1 block text-sm text-gray-300">Project Type</label>
                            <select wire:model="projectType" class="w-full rounded-md border border-gray-700 bg-gray-800 px-3 py-2 text-white">
                                <option value="">Select</option>
                                <option value="Business Website">Business Website</option>
                                <option value="E-commerce Website">E-commerce Website</option>
                                <option value="Web Application (SaaS)">Web Application (SaaS)</option>
                                <option value="Landing Page / Marketing Site">Landing Page / Marketing Site</option>
                                <option value="Booking or Directory Platform">Booking or Directory Platform</option>
                                <option value="Dashboard / Admin System">Dashboard / Admin System</option>
                                <option value="API Development / Integration">API Development / Integration</option>
                                <option value="Website Redesign / Upgrade">Website Redesign / Upgrade</option>
                                <option value="Bug Fixes / Maintenance">Bug Fixes / Maintenance</option>
                                <option value="Other Web Project">Other Web Project</option>
                            </select>
                            @error('projectType') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="mb-1 block text-sm text-gray-300">Budget Range</label>
                            <select wire:model="budgetRange" class="w-full rounded-md border border-gray-700 bg-gray-800 px-3 py-2 text-white">
                                <option value="">Select</option>
                                <option value="Under NGN 500,000">Under NGN 500,000</option>
                                <option value="NGN 500,000 - NGN 1,500,000">NGN 500,000 - NGN 1,500,000</option>
                                <option value="NGN 1,500,000 - NGN 3,000,000">NGN 1,500,000 - NGN 3,000,000</option>
                                <option value="NGN 3,000,000 - NGN 7,000,000">NGN 3,000,000 - NGN 7,000,000</option>
                                <option value="NGN 7,000,000+">NGN 7,000,000+</option>
                            </select>
                            @error('budgetRange') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="mb-1 block text-sm text-gray-300">Timeline</label>
                            <select wire:model="timeline" class="w-full rounded-md border border-gray-700 bg-gray-800 px-3 py-2 text-white">
                                <option value="">Select</option>
                                <option value="ASAP">ASAP</option>
                                <option value="2 - 4 Weeks">2 - 4 Weeks</option>
                                <option value="1 - 2 Months">1 - 2 Months</option>
                                <option value="Flexible">Flexible</option>
                            </select>
                            @error('timeline') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div>
                        <label class="mb-1 block text-sm text-gray-300">Goals</label>
                        <textarea wire:model="goals" rows="5" class="w-full rounded-md border border-gray-700 bg-gray-800 px-3 py-2 text-white"></textarea>
                        @error('goals') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="rounded-md bg-blue-600 px-5 py-2 text-sm font-semibold text-white hover:bg-blue-500">
                            Send Project Request
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <section id="about" class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="grid gap-8 lg:grid-cols-[1.1fr_0.9fr] lg:items-start">
            <div data-animate>
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-cyan-300">About</p>
                <h2 class="mt-2 text-3xl font-semibold text-white">A Builder Focused on Outcomes, Not Just Features</h2>
                @if ($about)
                    <div class="mt-6 whitespace-pre-line text-gray-300 leading-relaxed">{{ $about->content }}</div>
                @else
                    <p class="mt-6 text-gray-400">No content available.</p>
                    @auth
                        <a wire:navigate href="{{ route('abouts.create') }}" class="mt-4 inline-flex rounded-md bg-blue-600 px-4 py-2 text-sm font-medium hover:bg-blue-500">
                            Add About
                        </a>
                    @endauth
                @endif
            </div>

            <div class="grid gap-4 sm:grid-cols-2" data-animate>
                <article class="rounded-2xl border border-gray-700 bg-gray-900/80 p-5 card-lift">
                    <h3 class="text-lg font-semibold text-white">Product Engineering</h3>
                    <p class="mt-2 text-sm text-gray-300">From architecture to deployment, I build maintainable apps designed for long-term growth.</p>
                </article>
                <article class="rounded-2xl border border-gray-700 bg-gray-900/80 p-5 card-lift">
                    <h3 class="text-lg font-semibold text-white">EdTech Systems</h3>
                    <p class="mt-2 text-sm text-gray-300">Learning workflows, progress tracking, and interactive content that improve completion rates.</p>
                </article>
                <article class="rounded-2xl border border-gray-700 bg-gray-900/80 p-5 card-lift">
                    <h3 class="text-lg font-semibold text-white">Performance UX</h3>
                    <p class="mt-2 text-sm text-gray-300">Fast-loading interfaces with smooth micro-interactions and clean information hierarchy.</p>
                </article>
                <article class="rounded-2xl border border-gray-700 bg-gray-900/80 p-5 card-lift">
                    <h3 class="text-lg font-semibold text-white">Business Alignment</h3>
                    <p class="mt-2 text-sm text-gray-300">Every decision ties back to conversion, retention, reliability, and measurable value.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="bg-gray-950/80 border-y border-gray-800">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
            <div class="max-w-3xl" data-animate>
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-cyan-300">Process</p>
                <h2 class="mt-2 text-3xl font-semibold text-white">How I Take Ideas to Production</h2>
            </div>
            <div class="mt-10 grid gap-6 md:grid-cols-3">
                <article data-animate class="rounded-2xl border border-gray-700 bg-gray-900 p-6 step-glow">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-cyan-300">Step 01</p>
                    <h3 class="mt-3 text-xl font-semibold text-white">Discovery</h3>
                    <p class="mt-2 text-sm text-gray-300">Clarify goals, users, and success metrics so we solve the right problem first.</p>
                </article>
                <article data-animate class="rounded-2xl border border-gray-700 bg-gray-900 p-6 step-glow">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-cyan-300">Step 02</p>
                    <h3 class="mt-3 text-xl font-semibold text-white">Build</h3>
                    <p class="mt-2 text-sm text-gray-300">Ship scalable backend logic and responsive interfaces with clear iteration cycles.</p>
                </article>
                <article data-animate class="rounded-2xl border border-gray-700 bg-gray-900 p-6 step-glow">
                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-cyan-300">Step 03</p>
                    <h3 class="mt-3 text-xl font-semibold text-white">Optimize</h3>
                    <p class="mt-2 text-sm text-gray-300">Use analytics and feedback loops to improve engagement, speed, and outcomes.</p>
                </article>
            </div>
        </div>
    </section>

    @if ($caseStudies->isNotEmpty())
        <section id="case-studies" class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
            <div class="flex flex-wrap items-end justify-between gap-4" data-animate>
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-cyan-300">Case Studies</p>
                    <h2 class="mt-2 text-3xl font-semibold text-white">Spotlight Projects</h2>
                </div>
                <a wire:navigate href="{{ route('projects.index') }}" class="inline-flex rounded-md border border-white/30 bg-white/10 px-4 py-2 text-sm font-medium text-white hover:bg-white/20">
                    Browse Full Portfolio
                </a>
            </div>

            @if ($selectedCaseStudy)
                <div class="mt-8 grid gap-6 lg:grid-cols-[1.15fr_0.85fr]" data-animate>
                    <article class="overflow-hidden rounded-2xl border border-gray-700 bg-gray-900/90 card-lift">
                        @if ($selectedCaseStudy->cover_image)
                            <img src="{{ asset('storage/'.$selectedCaseStudy->cover_image) }}" alt="{{ $selectedCaseStudy->title }}" class="h-72 w-full object-cover sm:h-96">
                        @endif
                        <div class="p-6">
                            <h3 class="text-2xl font-semibold text-white">{{ $selectedCaseStudy->title }}</h3>
                            <p class="mt-3 line-clamp-5 text-gray-300">{{ $selectedCaseStudy->excerpt ?: 'No summary provided yet.' }}</p>
                            <div class="mt-5 flex flex-wrap gap-3">
                                <a wire:navigate href="{{ route('case-studies.show', $selectedCaseStudy) }}" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-500">
                                    Open Case Study
                                </a>
                                @if ($selectedCaseStudy->project_url)
                                    <a href="{{ $selectedCaseStudy->project_url }}" target="_blank" class="rounded-md border border-gray-600 px-4 py-2 text-sm font-semibold text-gray-200 hover:bg-gray-800">
                                        Visit Live
                                    </a>
                                @endif
                            </div>
                        </div>
                    </article>

                    <div class="space-y-3">
                        @foreach ($caseStudies as $caseStudy)
                            <button
                                type="button"
                                wire:click="selectCaseStudy({{ $caseStudy->id }})"
                                class="w-full rounded-xl border p-4 text-left transition {{ $selectedCaseStudy->id === $caseStudy->id ? 'border-cyan-300/50 bg-cyan-400/10' : 'border-gray-700 bg-gray-900/90 hover:border-gray-500' }}"
                            >
                                <p class="text-base font-semibold text-white">{{ $caseStudy->title }}</p>
                                <p class="mt-1 line-clamp-2 text-sm text-gray-300">{{ $caseStudy->excerpt ?: 'No summary provided yet.' }}</p>
                            </button>
                        @endforeach
                    </div>
                </div>
            @endif
        </section>
    @endif

    <section id="projects" class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-end justify-between gap-4" data-animate>
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-cyan-300">Work</p>
                <h2 class="mt-2 text-3xl font-semibold text-white">Featured Projects</h2>
            </div>
            <a wire:navigate href="{{ route('projects.index') }}" class="inline-flex rounded-md border border-white/30 bg-white/10 px-4 py-2 text-sm font-medium text-white hover:bg-white/20">
                Browse All
            </a>
        </div>

        <div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($projects as $project)
                <article data-animate class="group overflow-hidden rounded-2xl border border-gray-700 bg-gray-900/80 card-lift">
                    @if (count($project->imageMedia()) > 0)
                        <div class="overflow-hidden">
                            <img
                                src="{{ asset('storage/'.$project->imageMedia()[0]) }}"
                                alt="{{ $project->title }}"
                                class="h-52 w-full object-cover transition duration-700 group-hover:scale-110"
                            >
                        </div>
                    @endif
                    <div class="p-5">
                        <h3 class="text-xl font-semibold text-white">{{ $project->title }}</h3>
                        <p class="mt-2 line-clamp-3 text-sm text-gray-300">{{ $project->description }}</p>
                        <div class="mt-4">
                            <a wire:navigate href="{{ route('projects.show', $project) }}" class="text-sm font-semibold text-cyan-300 hover:text-cyan-200">
                                Explore Project ->
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <p class="text-gray-400">No projects available.</p>
            @endforelse
        </div>
    </section>

    @if ($testimonials->isNotEmpty())
        <section class="border-y border-gray-800 bg-gray-950/70">
            <div class="mx-auto max-w-4xl px-4 py-16 sm:px-6 lg:px-8">
                <div class="text-center" data-animate>
                    <p class="text-sm font-semibold uppercase tracking-[0.2em] text-cyan-300">Testimonials</p>
                    <h2 class="mt-2 text-3xl font-semibold text-white">What Clients Say</h2>
                </div>
                <div class="testimonial-stage mt-8 rounded-2xl border border-gray-700 bg-gray-900/90 p-8">
                    @foreach ($testimonials as $testimonial)
                        <article class="testimonial-slide {{ $loop->first ? 'is-active' : '' }} text-center">
                            <p class="text-lg text-gray-100">"{{ $testimonial->quote }}"</p>
                            <p class="mt-4 text-sm text-cyan-300">
                                {{ $testimonial->author_name }}
                                @if ($testimonial->author_role || $testimonial->company)
                                    , {{ trim(($testimonial->author_role ? $testimonial->author_role.' ' : '').($testimonial->company ?? '')) }}
                                @endif
                            </p>
                        </article>
                    @endforeach
                    <div class="mt-6 flex justify-center gap-2">
                        @foreach ($testimonials as $testimonial)
                            <button type="button" class="testimonial-dot {{ $loop->first ? 'is-active' : '' }} h-2.5 w-2.5 rounded-full bg-gray-600"></button>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section id="contact" class="relative overflow-hidden">
        <div class="pointer-events-none absolute -left-16 top-10 h-60 w-60 rounded-full bg-blue-500/20 blur-3xl"></div>
        <div class="mx-auto grid max-w-7xl gap-10 px-4 py-16 sm:px-6 lg:grid-cols-[0.95fr_1.05fr] lg:px-8">
            <div data-animate>
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-cyan-300">Contact</p>
                <h2 class="mt-2 text-3xl font-semibold text-white">Ready to Build Something Powerful?</h2>
                <p class="mt-4 text-gray-300">
                    Share your idea, timeline, and goals. I will reply with a practical roadmap and next steps.
                </p>
                <div class="mt-6 space-y-2 text-sm text-gray-300">
                    <p>Response window: usually within 24 hours.</p>
                    <p>Available for product builds, platform upgrades, and technical strategy.</p>
                </div>
            </div>

            <form wire:submit="submitContact" class="space-y-4 rounded-2xl border border-gray-700 bg-gray-900/90 p-6 shadow-2xl shadow-cyan-900/10" data-animate>
                <div>
                    <label for="name" class="mb-1 block text-sm text-gray-300">Name</label>
                    <input wire:model="name" id="name" type="text" class="w-full rounded-md border border-gray-700 bg-gray-800 px-3 py-2 text-white focus:border-cyan-400 focus:outline-none">
                    @error('name') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="email" class="mb-1 block text-sm text-gray-300">Email</label>
                    <input wire:model="email" id="email" type="email" class="w-full rounded-md border border-gray-700 bg-gray-800 px-3 py-2 text-white focus:border-cyan-400 focus:outline-none">
                    @error('email') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="message" class="mb-1 block text-sm text-gray-300">Message</label>
                    <textarea wire:model="message" id="message" rows="5" class="w-full rounded-md border border-gray-700 bg-gray-800 px-3 py-2 text-white focus:border-cyan-400 focus:outline-none"></textarea>
                    @error('message') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
                </div>
                <button type="submit" class="inline-flex rounded-md bg-blue-600 px-5 py-2 font-semibold text-white transition hover:-translate-y-0.5 hover:bg-blue-500">
                    Send Message
                </button>
            </form>
        </div>
    </section>
</main>
