<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobs - Find your Dream Job</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>

<body class="bg-orange-50/30 text-gray-800 antialiased overflow-x-hidden">

    <!-- Navbar -->
    <nav class="container mx-auto px-6 py-6 flex items-center justify-between relative z-20">
        <div class="flex items-center gap-12">
            <!-- Logo -->
            <a href="/" class="text-2xl font-bold flex items-center gap-1">
                <span class="text-orange-500">I-</span><span class="relative">
                    <svg class="w-5 h-5 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-orange-500/20"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 9a2 2 0 114 0 2 2 0 01-4 0z" />
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a4 4 0 00-3.446 6.032l-2.261 2.26a1 1 0 101.414 1.415l2.261-2.261A4 4 0 1011 5z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Work</span>
                </span>
            </a>

            <!-- Links -->
            <div class="hidden md:flex items-center gap-8 font-medium text-gray-600">
                <a href="#" class="text-orange-500">Home</a>
                <a href="#" class="hover:text-orange-500 transition">Employer</a>
                <a href="#" class="hover:text-orange-500 transition">Candidate</a>
            </div>
        </div>

        <!-- Auth Buttons -->
        <div class="flex items-center gap-4">
            <a href="{{ route('login.show') }}"
                class="font-medium text-gray-700 hover:text-orange-500 transition">Login</a>
            <a href="{{ route('register.show') }}"
                class="bg-orange-400 hover:bg-orange-500 text-white px-6 py-2.5 rounded-full font-medium transition shadow-lg shadow-orange-500/20">Sign
                Up</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="container mx-auto px-6 pt-8 pb-20 grid lg:grid-cols-2 gap-12 items-center relative z-10">
        <!-- Text Content -->
        <div class="space-y-8 max-w-xl">
            <h1 class="text-5xl md:text-6xl font-bold leading-tight">
                Find the job of <br>
                your <span class="text-orange-400">Dreams</span>
            </h1>

            <p class="text-gray-500 text-lg leading-relaxed max-w-md">
                Find Your New Job Today! New Job Postings Everyday just for you, browse the job you want and apply
                wherever you want.
            </p>

            <div class="space-y-3">
                <p class="font-medium text-gray-700">Trending Jobs keyword :</p>
                <div class="flex flex-wrap gap-2 text-orange-400 font-medium text-sm">
                    <span class="bg-transparent cursor-pointer">Web Designer</span>
                    <span class="bg-transparent cursor-pointer">UI/UX Designer</span>
                    <span class="bg-transparent cursor-pointer">Frontend</span>
                </div>
            </div>

            <!-- Search Bar -->
            <div
                class="bg-white p-2 rounded-full shadow-xl shadow-gray-100/50 flex flex-col md:flex-row divide-y md:divide-y-0 md:divide-x divide-gray-100 border border-gray-100 max-w-lg">
                <div class="flex-1 flex items-center px-4 py-3 md:py-2">
                    <svg class="w-5 h-5 text-orange-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" placeholder="Job title or keyword"
                        class="w-full bg-transparent outline-none text-sm placeholder-gray-400 text-gray-700">
                </div>
                <div class="flex-1 flex items-center px-4 py-3 md:py-2">
                    <svg class="w-5 h-5 text-orange-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <input type="text" placeholder="Bandung, Indonesia"
                        class="w-full bg-transparent outline-none text-sm placeholder-gray-400 text-gray-700">
                </div>
                <div class="p-1">
                    <button
                        class="bg-orange-400 hover:bg-orange-500 text-white px-8 py-2.5 rounded-full font-medium transition w-full md:w-auto h-full">Search</button>
                </div>
            </div>
        </div>

        <!-- Image Content -->
        <div class="relative mt-8 lg:mt-0">
            <!-- Background Shape -->
            <svg class="absolute top-0 right-0 w-full h-full text-orange-400/10 transform scale-125 -z-10"
                viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <path fill="currentColor"
                    d="M44.7,-76.4C58.9,-69.2,71.8,-59.1,81.6,-46.6C91.4,-34.1,98.1,-19.2,95.8,-4.9C93.5,9.4,82.2,23.1,72.4,36.5C62.6,49.9,54.3,63,42.7,71.5C31.1,80,16.2,83.9,0.5,83.1C-15.2,82.3,-31.6,76.8,-45.5,67.6C-59.4,58.4,-70.8,45.5,-77.8,31C-84.8,16.5,-87.4,0.4,-84.9,-14.8C-82.4,-30,-74.8,-44.3,-63.3,-53.4C-51.8,-62.5,-36.4,-66.4,-21.8,-69.9C-7.2,-73.4,6.6,-76.5,19.3,-74.2C32,-71.9,43,-64.2,44.7,-76.4Z"
                    transform="translate(100 100)" />
            </svg>

            <!-- Orange Circle -->
            <div
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[400px] h-[400px] bg-orange-400 rounded-full -z-10 opacity-90">
            </div>

            <!-- Person Image (Placeholder) -->
            <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=688&auto=format&fit=crop"
                alt="Happy worker"
                class="relative z-10 mx-auto w-[400px] h-auto object-cover rounded-b-full mask-image-gradient">

            <!-- Floating Cards -->
            <div
                class="absolute top-20 right-10 bg-white p-3 rounded-2xl shadow-lg z-20 flex flex-col items-center animate-bounce-slow">
                <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center mb-1 text-white text-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <span class="font-bold text-gray-800 text-sm">10.5K</span>
                <span class="text-xs text-gray-500">Job Vacancy</span>
            </div>

            <div
                class="absolute bottom-20 left-0 bg-white/90 backdrop-blur-sm p-4 rounded-xl shadow-lg z-20 flex items-center gap-3 border border-orange-100 max-w-[150px]">
                <div class="bg-orange-100 p-2 rounded-lg text-orange-500">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <div class="text-[10px] text-gray-500 font-medium">Quick replies</div>
                    <div class="text-xs font-bold text-gray-800">in few seconds</div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="container mx-auto px-6 py-12 text-center border-t border-gray-100/50">
        <p class="text-gray-500 mb-8 font-medium">Copyright I-Work</p>

    </footer>

</body>

</html>