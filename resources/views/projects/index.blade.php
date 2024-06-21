<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>
    <link rel="stylesheet" href="owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="owlcarousel/owl.theme.default.min.css">

    <script src="jquery.min.js"></script>
    <script src="owlcarousel/owl.carousel.min.js"></script>
</head>

<body class="bg-gray-800 text-white">
    <section id="projects" class="py-16 bg-gray-800">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-center text-white">Projects</h2>
            <div class=" mt-8 owl-carousel owl-theme">
                @foreach ($projects as $project)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="owl-carousel owl-theme project-carousel">
                        @php
                            $mediaItems = explode(',', $project->media);
                        @endphp
                        @foreach ($mediaItems as $media)
                            @if (strpos($media, '.jpg') !== false || strpos($media, '.png') !== false)
                                <img src="{{ asset('storage/' . trim($media)) }}" alt="Project Image" class="w-full h-48 object-cover">
                            @elseif (strpos($media, '.mp4') !== false || strpos($media, '.webm') !== false)
                                <video controls class="w-full h-48 object-cover">
                                    <source src="{{ asset('storage/' . trim($media)) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @endif
                        @endforeach
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl text-gray-700 font-bold">{{ $project->title }}</h3>
                        <p class="mt-2 text-gray-600">{{ $project->description }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    
    <script>
        $(document).ready(function(){
            $(".owl-carousel").owlCarousel({
                items: 1,
                loop: true,
                margin: 10,
                responsiveClass:true,
                responsive:{
                    0:{
                        items:1,
                        nav:true
                    },
                    600:{
                        items:2,
                        nav:false
                    },
                    1000:{
                        items:3,
                        nav:true,
                        loop:false
                    }
                }
            });
        });
    </script>
</body>
</html>
