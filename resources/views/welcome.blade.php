<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name')}}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

        <!-- Styles -->
        <style>
            /* ! tailwindcss v3.4.1 | MIT License | https://tailwindcss.com */*,::after,::before{box-sizing:border-box;border-width:0;border-style:solid;border-color:#e5e7eb}::after,::before{--tw-content:''}:host,html{line-height:1.5;-webkit-text-size-adjust:100%;-moz-tab-size:4;tab-size:4;font-family:Figtree, ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;font-feature-settings:normal;font-variation-settings:normal;-webkit-tap-highlight-color:transparent}body{margin:0;line-height:inherit}hr{height:0;color:inherit;border-top-width:1px}abbr:where([title]){-webkit-text-decoration:underline dotted;text-decoration:underline dotted}h1,h2,h3,h4,h5,h6{font-size:inherit;font-weight:inherit}a{color:inherit;text-decoration:inherit}b,strong{font-weight:bolder}code,kbd,pre,samp{font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;font-feature-settings:normal;font-variation-settings:normal;font-size:1em}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}table{text-indent:0;border-color:inherit;border-collapse:collapse}button,input,optgroup,select,textarea{font-family:inherit;font-feature-settings:inherit;font-variation-settings:inherit;font-size:100%;font-weight:inherit;line-height:inherit;color:inherit;margin:0;padding:0}button,select{text-transform:none}[type=button],[type=reset],[type=submit],button{-webkit-appearance:button;background-color:transparent;background-image:none}:-moz-focusring{outline:auto}:-moz-ui-invalid{box-shadow:none}progress{vertical-align:baseline}::-webkit-inner-spin-button,::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;outline-offset:-2px}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}summary{display:list-item}blockquote,dd,dl,figure,h1,h2,h3,h4,h5,h6,hr,p,pre{margin:0}fieldset{margin:0;padding:0}legend{padding:0}menu,ol,ul{list-style:none;margin:0;padding:0}dialog{padding:0}textarea{resize:vertical}input::placeholder,textarea::placeholder{opacity:1;color:#9ca3af}[role=button],button{cursor:pointer}:disabled{cursor:default}audio,canvas,embed,iframe,img,object,svg,video{display:block;vertical-align:middle}img,video{max-width:100%;height:auto}[hidden]{display:none}*, ::before, ::after{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-gradient-from-position: ;--tw-gradient-via-position: ;--tw-gradient-to-position: ;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }::backdrop{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-gradient-from-position: ;--tw-gradient-via-position: ;--tw-gradient-to-position: ;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }.absolute{position:absolute}.relative{position:relative}.-left-20{left:-5rem}.top-0{top:0px}.-bottom-16{bottom:-4rem}.-left-16{left:-4rem}.-mx-3{margin-left:-0.75rem;margin-right:-0.75rem}.mt-4{margin-top:1rem}.mt-6{margin-top:1.5rem}.flex{display:flex}.grid{display:grid}.hidden{display:none}.aspect-video{aspect-ratio:16 / 9}.size-12{width:3rem;height:3rem}.size-5{width:1.25rem;height:1.25rem}.size-6{width:1.5rem;height:1.5rem}.h-12{height:3rem}.h-40{height:10rem}.h-full{height:100%}.min-h-screen{min-height:100vh}.w-full{width:100%}.w-\[calc\(100\%\+8rem\)\]{width:calc(100% + 8rem)}.w-auto{width:auto}.max-w-\[877px\]{max-width:877px}.max-w-2xl{max-width:42rem}.flex-1{flex:1 1 0%}.shrink-0{flex-shrink:0}.grid-cols-2{grid-template-columns:repeat(2, minmax(0, 1fr))}.flex-col{flex-direction:column}.items-start{align-items:flex-start}.items-center{align-items:center}.items-stretch{align-items:stretch}.justify-end{justify-content:flex-end}.justify-center{justify-content:center}.gap-2{gap:0.5rem}.gap-4{gap:1rem}.gap-6{gap:1.5rem}.self-center{align-self:center}.overflow-hidden{overflow:hidden}.rounded-\[10px\]{border-radius:10px}.rounded-full{border-radius:9999px}.rounded-lg{border-radius:0.5rem}.rounded-md{border-radius:0.375rem}.rounded-sm{border-radius:0.125rem}.bg-\[\#FF2D20\]\/10{background-color:rgb(255 45 32 / 0.1)}.bg-white{--tw-bg-opacity:1;background-color:rgb(255 255 255 / var(--tw-bg-opacity))}.bg-gradient-to-b{background-image:linear-gradient(to bottom, var(--tw-gradient-stops))}.from-transparent{--tw-gradient-from:transparent var(--tw-gradient-from-position);--tw-gradient-to:rgb(0 0 0 / 0) var(--tw-gradient-to-position);--tw-gradient-stops:var(--tw-gradient-from), var(--tw-gradient-to)}.via-white{--tw-gradient-to:rgb(255 255 255 / 0)  var(--tw-gradient-to-position);--tw-gradient-stops:var(--tw-gradient-from), #fff var(--tw-gradient-via-position), var(--tw-gradient-to)}.to-white{--tw-gradient-to:#fff var(--tw-gradient-to-position)}.stroke-\[\#FF2D20\]{stroke:#FF2D20}.object-cover{object-fit:cover}.object-top{object-position:top}.p-6{padding:1.5rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.py-10{padding-top:2.5rem;padding-bottom:2.5rem}.px-3{padding-left:0.75rem;padding-right:0.75rem}.py-16{padding-top:4rem;padding-bottom:4rem}.py-2{padding-top:0.5rem;padding-bottom:0.5rem}.pt-3{padding-top:0.75rem}.text-center{text-align:center}.font-sans{font-family:Figtree, ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji}.text-sm{font-size:0.875rem;line-height:1.25rem}.text-sm\/relaxed{font-size:0.875rem;line-height:1.625}.text-xl{font-size:1.25rem;line-height:1.75rem}.font-semibold{font-weight:600}.text-black{--tw-text-opacity:1;color:rgb(0 0 0 / var(--tw-text-opacity))}.text-white{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.underline{-webkit-text-decoration-line:underline;text-decoration-line:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.shadow-\[0px_14px_34px_0px_rgba\(0\2c 0\2c 0\2c 0\.08\)\]{--tw-shadow:0px 14px 34px 0px rgba(0,0,0,0.08);--tw-shadow-colored:0px 14px 34px 0px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}.ring-1{--tw-ring-offset-shadow:var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow:var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)}.ring-transparent{--tw-ring-color:transparent}.ring-white\/\[0\.05\]{--tw-ring-color:rgb(255 255 255 / 0.05)}.drop-shadow-\[0px_4px_34px_rgba\(0\2c 0\2c 0\2c 0\.06\)\]{--tw-drop-shadow:drop-shadow(0px 4px 34px rgba(0,0,0,0.06));filter:var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow)}.drop-shadow-\[0px_4px_34px_rgba\(0\2c 0\2c 0\2c 0\.25\)\]{--tw-drop-shadow:drop-shadow(0px 4px 34px rgba(0,0,0,0.25));filter:var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow)}.transition{transition-property:color, background-color, border-color, fill, stroke, opacity, box-shadow, transform, filter, -webkit-text-decoration-color, -webkit-backdrop-filter;transition-property:color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;transition-property:color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter, -webkit-text-decoration-color, -webkit-backdrop-filter;transition-timing-function:cubic-bezier(0.4, 0, 0.2, 1);transition-duration:150ms}.duration-300{transition-duration:300ms}.selection\:bg-\[\#FF2D20\] *::selection{--tw-bg-opacity:1;background-color:rgb(255 45 32 / var(--tw-bg-opacity))}.selection\:text-white *::selection{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.selection\:bg-\[\#FF2D20\]::selection{--tw-bg-opacity:1;background-color:rgb(255 45 32 / var(--tw-bg-opacity))}.selection\:text-white::selection{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.hover\:text-black:hover{--tw-text-opacity:1;color:rgb(0 0 0 / var(--tw-text-opacity))}.hover\:text-black\/70:hover{color:rgb(0 0 0 / 0.7)}.hover\:ring-black\/20:hover{--tw-ring-color:rgb(0 0 0 / 0.2)}.focus\:outline-none:focus{outline:2px solid transparent;outline-offset:2px}.focus-visible\:ring-1:focus-visible{--tw-ring-offset-shadow:var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow:var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)}.focus-visible\:ring-\[\#FF2D20\]:focus-visible{--tw-ring-opacity:1;--tw-ring-color:rgb(255 45 32 / var(--tw-ring-opacity))}@media (min-width: 640px){.sm\:size-16{width:4rem;height:4rem}.sm\:size-6{width:1.5rem;height:1.5rem}.sm\:pt-5{padding-top:1.25rem}}@media (min-width: 768px){.md\:row-span-3{grid-row:span 3 / span 3}}@media (min-width: 1024px){.lg\:col-start-2{grid-column-start:2}.lg\:h-16{height:4rem}.lg\:max-w-7xl{max-width:80rem}.lg\:grid-cols-3{grid-template-columns:repeat(3, minmax(0, 1fr))}.lg\:grid-cols-2{grid-template-columns:repeat(2, minmax(0, 1fr))}.lg\:flex-col{flex-direction:column}.lg\:items-end{align-items:flex-end}.lg\:justify-center{justify-content:center}.lg\:gap-8{gap:2rem}.lg\:p-10{padding:2.5rem}.lg\:pb-10{padding-bottom:2.5rem}.lg\:pt-0{padding-top:0px}.lg\:text-\[\#FF2D20\]{--tw-text-opacity:1;color:rgb(255 45 32 / var(--tw-text-opacity))}}@media (prefers-color-scheme: dark){.dark\:block{display:block}.dark\:hidden{display:none}.dark\:bg-black{--tw-bg-opacity:1;background-color:rgb(0 0 0 / var(--tw-bg-opacity))}.dark\:bg-zinc-900{--tw-bg-opacity:1;background-color:rgb(24 24 27 / var(--tw-bg-opacity))}.dark\:via-zinc-900{--tw-gradient-to:rgb(24 24 27 / 0)  var(--tw-gradient-to-position);--tw-gradient-stops:var(--tw-gradient-from), #18181b var(--tw-gradient-via-position), var(--tw-gradient-to)}.dark\:to-zinc-900{--tw-gradient-to:#18181b var(--tw-gradient-to-position)}.dark\:text-white\/50{color:rgb(255 255 255 / 0.5)}.dark\:text-white{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.dark\:text-white\/70{color:rgb(255 255 255 / 0.7)}.dark\:ring-zinc-800{--tw-ring-opacity:1;--tw-ring-color:rgb(39 39 42 / var(--tw-ring-opacity))}.dark\:hover\:text-white:hover{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.dark\:hover\:text-white\/70:hover{color:rgb(255 255 255 / 0.7)}.dark\:hover\:text-white\/80:hover{color:rgb(255 255 255 / 0.8)}.dark\:hover\:ring-zinc-700:hover{--tw-ring-opacity:1;--tw-ring-color:rgb(63 63 70 / var(--tw-ring-opacity))}.dark\:focus-visible\:ring-\[\#FF2D20\]:focus-visible{--tw-ring-opacity:1;--tw-ring-color:rgb(255 45 32 / var(--tw-ring-opacity))}.dark\:focus-visible\:ring-white:focus-visible{--tw-ring-opacity:1;--tw-ring-color:rgb(255 255 255 / var(--tw-ring-opacity))}}
        </style>
                @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-800 text-gray-100">
        <nav class="bg-gray-900 shadow-lg py-6">
            <div class="container mx-auto flex justify-between items-center px-6">
                <div class="flex items-center">
                    <img src="images/profileImage.jpg" alt="profile picture" class="h-8 w-8 mr-3 rounded-full">
                    <div class="text-2xl font-bold text-white">DocPhils</div>
                </div>
                <div class="hidden md:flex space-x-6">
                    <a href="#about" class="text-lg text-white hover:text-gray-300 px-1 rounded-md shadow-lg shadow-gray-600 transition duration-300">About</a>
                    <a href="#projects" class="text-lg text-white shadow-lg shadow-gray-600 px-1 rounded-md hover:text-gray-300 transition duration-300">Projects</a>
                    <a href="#contact" class="text-lg text-white shadow-lg shadow-gray-600  px-1 rounded-md hover:text-gray-300 transition duration-300">Contact</a>
                    @if (auth()->check())
                        <a href="{{ route('dashboard') }}" class="text-lg text-white shadow-lg  px-1 rounded-md shadow-gray-600 hover:text-gray-300 transition duration-300">Dashboard</a>
                    @endif
                </div>
                <div class="md:hidden">
                    <button id="menu-button" class="text-white focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <div id="mobile-menu" class="hidden md:hidden px-6 pt-4 pb-2 space-y-2">
                <a href="#about" class="block text-lg text-white hover:text-gray-300 transition duration-300">About</a>
                <a href="#projects" class="block text-lg text-white hover:text-gray-300 transition duration-300">Projects</a>
                <a href="#contact" class="block text-lg text-white hover:text-gray-300 transition duration-300">Contact</a>
                @if (auth()->check())
                    <a href="{{ route('dashboard') }}" class="block text-lg text-white hover:text-gray-300 transition duration-300">Dashboard</a>
                @endif
            </div>
           
        </nav>
    
        <!-- Hero Section -->
        <section class="bg-cover bg-center h-screen relative" style="background-image: url('images/portfolioimage.jpg');">
            @if(session('success'))
                    <div class="bg-green-300 text-white p-4 mb-4 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-300 text-white p-4 mb-4 rounded-lg">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            <div class="absolute inset-0 bg-gray-900 bg-opacity-50 hover:bg-opacity-90"></div> <!-- Overlay -->
            <div class="container mx-auto h-full flex items-center justify-center relative">
                <div class="text-center text-white p-8 rounded-lg">
                    <h1 class="text-5xl font-bold hover:animate-bounce">Meet DocPhils</h1>
                    <p class="mt-4 text-2xl">Fullstack Laravel Developer, I.T Instructor, and H.R Professional</p>
                    <a href="#contact" class="mt-8 inline-block bg-blue-500 text-xl text-white py-3 px-6 font-bold rounded-lg hover:bg-blue-600 transition duration-300">Hire Me</a>
                </div>
            </div>
        </section>
    
        <!-- About Section -->
        <section id="about" class="py-16 bg-gray-900">
            <div class="container mx-auto px-6">
                <h2 class="text-4xl font-bold py-3 text-center text-white">About Me</h2>
                @if($about)
                    <div class="prose prose-2xl text-justify text-gray-300">
                        {!! nl2br(e($about->content)) !!}
                    </div>                
                @else
                    <p class="mt-4 text-lg text-center max-w-3xl mx-auto text-gray-300">No content available.</p>
                    @if (auth()->check())
                        <a href="{{ route('abouts.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add About</a>
                    @endif
                @endif
                
            </div>
        </section>
    
        <!-- Projects Section -->
        <section id="projects" class="py-16 bg-gray-800">
            <div class="container mx-auto px-6">
                <h2 class="text-4xl font-bold text-center text-white">Projects</h2>
                <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Project  -->
                    @foreach($projects as $project)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="relative">
                            <!-- Slider Container -->
                            <div id="slider-{{ $loop->index }}" class="slider w-full gap-3 h-48 flex overflow-hidden">
                                <!-- Slider Items -->
                                @php
                                $imageMedia = array_filter(explode(',', $project['media']), function($media) {
                                    return Str::endsWith($media, ['.jpg', '.jpeg', '.png', '.gif']);
                                });
                                @endphp

                                @foreach($imageMedia as $image)
                                <div class="w-full h-48 flex-shrink-0">
                                    <img src="{{ asset('storage/' . trim($image)) }}" alt="Project Image">
                                </div>
                                @endforeach
                            </div>
                            <!-- Pagination Buttons -->
                            <div class="absolute inset-0 flex justify-between items-center p-4">
                                <button id="prev-{{ $loop->index }}" class="prev bg-gray-800 text-white px-2 py-1 rounded-full opacity-75 hover:opacity-100">Prev</button>
                                <button id="next-{{ $loop->index }}" class="next bg-gray-800 text-white px-2 py-1 rounded-full opacity-75 hover:opacity-100">Next</button>
                            </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-2xl text-gray-700 font-bold">{{ $project->title }}</h3>
                                <p class="mt-2 text-gray-600 line-clamp-2">{{ $project->description }}</p>
                            </div>
                    </div>
                    @endforeach
                </div>
                <div class="mx-auto text-center my-3">
                    <a href="{{ route('projects.index')}}" class="text-lg bg-gray-600 text-white p-2 rounded-lg hover:bg-gray-700">More Projects</a>
                </div>
            </div>
        </section>
        <hr>
    
        <!-- Contact Section -->
        <section id="contact" class="py-10 bg-gray-800">
            <div class="container mx-auto px-6">
                <h2 class="text-4xl font-bold text-center text-white">Contact</h2>
                <p class="mt-4 text-lg text-center max-w-2xl mx-auto text-gray-300">Feel free to reach out to me via the form below for any inquiries or collaboration opportunities.</p>
                <form method="POST" action="{{ route('contacts.store') }}" class="mt-8 max-w-xl mx-auto bg-gray-900 p-8 rounded-lg">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-gray-100 text-sm font-bold mb-2">Name</label>
                        <input type="text" id="name" name="name" class="w-full px-3 py-2 border rounded-lg bg-gray-700 text-white" placeholder="Your Name" autocomplete="off" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-100 text-sm font-bold mb-2">Email</label>
                        <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded-lg bg-gray-700 text-white" placeholder="Your Email"autocomplete="off"  required>
                    </div>
                    <div class="mb-4">
                        <label for="message" class="block text-gray-100 text-sm font-bold mb-2">Message</label>
                        <textarea id="message" name="message" class="w-full px-3 py-2 border rounded-lg bg-gray-700 text-white" placeholder="Your Message" autocomplete="off" required></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 transition duration-300">Send Message</button>
                    </div>
                </form>
                
            </div>
        </section>
    
        <!-- Footer -->
        <footer class="py-4 bg-gray-900 text-white">
            <div class="container mx-auto text-center">
                <p>&copy; 2024 DocPhils. All rights reserved.</p>
            </div>
        </footer>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const sliders = document.querySelectorAll('.slider');
        
                sliders.forEach((slider, index) => {
                    const next = document.getElementById(`next-${index}`);
                    const prev = document.getElementById(`prev-${index}`);
                    let slideIndex = 0;
        
                    const showSlide = (index) => {
                        const slides = slider.children;
                        for (let i = 0; i < slides.length; i++) {
                            slides[i].style.transform = `translateX(-${index * 100}%)`;
                        }
                    }
        
                    next.addEventListener('click', () => {
                        slideIndex = (slideIndex + 1) % slider.children.length;
                        showSlide(slideIndex);
                    });
        
                    prev.addEventListener('click', () => {
                        slideIndex = (slideIndex - 1 + slider.children.length) % slider.children.length;
                        showSlide(slideIndex);
                    });
                });
            });
        </script>
        
    </body>
    
</html>
