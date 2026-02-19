<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>About Us - Laravel Blog</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS via CDN for quick styling -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }
    </style>
</head>
<body class="antialiased bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
    <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-red-500 selection:text-white">
        
        <nav class="w-full max-w-7xl mx-auto p-6 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <a href="/" class="text-2xl font-bold text-gray-900 dark:text-white hover:text-red-500 transition-colors">
                    Laravel<span class="text-red-500">Blog</span>
                </a>
            </div>
            <div class="flex items-center space-x-6">
                <a href="/" class="font-semibold hover:text-red-500 transition-colors">Home</a>
                <a href="/blog" class="font-semibold hover:text-red-500 transition-colors">Blog</a>
                <a href="/hello" class="font-semibold hover:text-red-500 transition-colors">Hello</a>
                <a href="/about" class="font-semibold text-red-500 underline decoration-2 underline-offset-4">About</a>
            </div>
        </nav>

        <main class="flex-grow w-full max-w-4xl mx-auto px-6 py-12">
            <section class="mb-16 text-center">
                <h1 class="text-5xl font-extrabold tracking-tight mb-4 text-gray-900 dark:text-white">
                    About <span class="text-red-500">Us</span>
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto leading-relaxed">
                    Welcome to our Laravel-powered blog. We are passionate about sharing knowledge and building amazing web experiences.
                </p>
            </section>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div class="space-y-6">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Our Mission</h2>
                    <p class="leading-relaxed text-gray-600 dark:text-gray-400">
                        Our mission is to provide high-quality content that helps developers grow their skills and stay updated with the latest trends in the Laravel ecosystem. We believe in the power of community and open-source software.
                    </p>
                    <p class="leading-relaxed text-gray-600 dark:text-gray-400">
                        Whether you're a beginner just starting out or a seasoned pro, there's something here for everyone. We cover everything from basic routing to complex architectural patterns.
                    </p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-xl shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-gray-700">
                    <h2 class="text-3xl font-bold mb-6 text-gray-900 dark:text-white">What We Offer</h2>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <span class="bg-red-100 dark:bg-red-900/30 text-red-600 p-1 rounded-full mr-3 mt-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </span>
                            <span>Deep-dive Laravel tutorials</span>
                        </li>
                        <li class="flex items-start">
                            <span class="bg-red-100 dark:bg-red-900/30 text-red-600 p-1 rounded-full mr-3 mt-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </span>
                            <span>Best practices and clean code tips</span>
                        </li>
                        <li class="flex items-start">
                            <span class="bg-red-100 dark:bg-red-900/30 text-red-600 p-1 rounded-full mr-3 mt-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </span>
                            <span>News from the Laravel ecosystem</span>
                        </li>
                        <li class="flex items-start">
                            <span class="bg-red-100 dark:bg-red-900/30 text-red-600 p-1 rounded-full mr-3 mt-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </span>
                            <span>Community spotlights and interviews</span>
                        </li>
                    </ul>
                </div>
            </div>

            <section class="mt-20 text-center bg-red-500 rounded-3xl p-12 text-white">
                <h2 class="text-3xl font-bold mb-4">Join Our Journey</h2>
                <p class="text-lg mb-8 opacity-90">Stay updated with our latest posts and announcements.</p>
                <a href="#" class="bg-white text-red-500 font-bold py-3 px-8 rounded-full hover:bg-gray-100 transition-colors inline-block">
                    Subscribe Now
                </a>
            </section>
        </main>

        <footer class="w-full max-w-7xl mx-auto p-6 mt-auto border-t border-gray-200 dark:border-gray-800 flex flex-col sm:flex-row justify-between items-center text-sm text-gray-500">
            <p>&copy; 2024 Laravel Blog. Built with Laravel v{{ Illuminate\Foundation\Application::VERSION }}.</p>
            <div class="flex space-x-4 mt-4 sm:mt-0">
                <a href="/" class="hover:text-red-500 transition-colors">Home</a>
                <a href="/blog" class="hover:text-red-500 transition-colors">Blog</a>
                <a href="/hello" class="hover:text-red-500 transition-colors">Hello</a>
                <a href="/about" class="hover:text-red-500 transition-colors text-red-500">About</a>
            </div>
        </footer>
    </div>
</body>
</html>
