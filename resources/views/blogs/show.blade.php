<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $blog->title }} - Laravel Blog</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }
        @keyframes highlight {
            0% { background-color: rgba(239, 68, 68, 0.2); }
            100% { background-color: transparent; }
        }
        .update-highlight {
            animation: highlight 2s ease-out;
        }
    </style>
</head>
<body class="antialiased bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
    <div class="relative min-h-screen flex flex-col selection:bg-red-500 selection:text-white">
        
        <nav class="w-full max-w-7xl mx-auto p-6 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <a href="/" class="text-2xl font-bold text-gray-900 dark:text-white hover:text-red-500 transition-colors">
                    Laravel<span class="text-red-500">Blog</span>
                </a>
            </div>
            <div class="flex items-center space-x-6">
                <a href="/" class="font-semibold hover:text-red-500 transition-colors">Home</a>
                <a href="/blog" class="font-semibold text-red-500 underline decoration-2 underline-offset-4">Blog</a>
                <a href="/chat" class="font-semibold hover:text-red-500 transition-colors">Chat</a>
                <a href="/about" class="font-semibold hover:text-red-500 transition-colors">About</a>
            </div>
        </nav>

        <main class="flex-grow w-full max-w-4xl mx-auto px-6 py-12">
            @if (session('success'))
                <div class="mb-8 p-4 bg-green-100 border border-green-400 text-green-700 rounded-2xl shadow-sm flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-12 flex justify-between items-center">
                <a href="/blog" class="group text-gray-500 hover:text-red-500 font-bold transition-colors inline-flex items-center">
                    <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    Back to Blog
                </a>

                <a href="{{ route('blog.edit', $blog) }}" class="bg-gray-900 dark:bg-white text-white dark:text-gray-900 px-8 py-3 rounded-full font-black hover:bg-red-500 hover:text-white dark:hover:bg-red-500 dark:hover:text-white transition-all shadow-xl active:transform active:scale-95 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Edit Post
                </a>
            </div>

            <article>
                <header class="mb-12">
                    <div class="relative h-[400px] md:h-[500px] w-full mb-12 rounded-[3rem] overflow-hidden shadow-2xl">
                        <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" class="absolute inset-0 w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 via-transparent to-transparent"></div>
                    </div>
                    <div class="flex items-center space-x-3 text-red-500 mb-6 text-sm font-bold uppercase tracking-widest">
                        <span>Article</span>
                        <span>&bull;</span>
                        <time>{{ $blog->created_at->format('M d, Y') }}</time>
                    </div>
                    <h1 id="blog-title" class="text-5xl md:text-6xl font-black tracking-tight mb-8 text-gray-900 dark:text-white leading-[1.1]">
                        {{ $blog->title }}
                    </h1>
                    <div class="flex items-center p-6 bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm">
                        <div class="h-12 w-12 bg-red-500 rounded-2xl flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-red-500/20 mr-4">
                            {{ substr($blog->user->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-sm text-gray-900 dark:text-white font-bold uppercase tracking-wider mb-1">Written by</p>
                            <p class="font-black text-gray-900 dark:text-white text-lg leading-none">{{ $blog->user->name }}</p>
                        </div>
                    </div>
                </header>

                <div id="blog-content" class="prose prose-xl dark:prose-invert max-w-none text-gray-700 dark:text-gray-300 leading-relaxed space-y-8 text-xl">
                    {!! nl2br(e($blog->content)) !!}
                </div>
            </article>

            <div class="mt-24 p-12 bg-gray-900 rounded-[3rem] text-center relative overflow-hidden">
                <div class="absolute inset-0 bg-red-500/10"></div>
                <div class="relative z-10">
                    <h3 class="text-3xl font-black mb-4 text-white">Share this post</h3>
                    <p class="text-gray-400 mb-8 max-w-md mx-auto">Found this interesting? Share it with your network and help others discover it.</p>
                    <div class="flex flex-wrap justify-center gap-4">
                        <button class="bg-[#1DA1F2] text-white px-8 py-3 rounded-full font-bold hover:opacity-90 transition-opacity flex items-center">
                            Twitter
                        </button>
                        <button class="bg-[#4267B2] text-white px-8 py-3 rounded-full font-bold hover:opacity-90 transition-opacity flex items-center">
                            Facebook
                        </button>
                        <button class="bg-white text-gray-900 px-8 py-3 rounded-full font-bold hover:bg-gray-100 transition-colors flex items-center">
                            Copy Link
                        </button>
                    </div>
                </div>
            </div>
        </main>

        <footer class="w-full max-w-7xl mx-auto p-6 mt-auto border-t border-gray-200 dark:border-gray-800 flex flex-col sm:flex-row justify-between items-center text-sm text-gray-500">
            <p>&copy; 2024 Laravel Blog. Built with Laravel v{{ Illuminate\Foundation\Application::VERSION }}.</p>
            <div class="flex space-x-4 mt-4 sm:mt-0">
                <a href="/" class="hover:text-red-500 transition-colors">Home</a>
                <a href="/blog" class="hover:text-red-500 transition-colors text-red-500">Blog</a>
                <a href="/chat" class="hover:text-red-500 transition-colors">Chat</a>
                <a href="/about" class="hover:text-red-500 transition-colors">About</a>
            </div>
        </footer>
    </div>

    <script>
            let lastUpdated = "{{ $blog->updated_at->toIso8601String() }}";
            const blogId = "{{ $blog->id }}";
            const titleEl = document.getElementById('blog-title');
            const contentEl = document.getElementById('blog-content');

            function checkUpdates() {
                fetch(`/blog/${blogId}/data`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.updated_at !== lastUpdated) {
                            console.log('Update detected!');
                        
                            // Update content
                            if (titleEl.innerText !== data.title) {
                                titleEl.innerText = data.title;
                                titleEl.classList.remove('update-highlight');
                                void titleEl.offsetWidth; // Trigger reflow
                                titleEl.classList.add('update-highlight');
                            }
                        
                            // We use innerHTML because we nl2br'd it on the server
                            if (contentEl.innerHTML !== data.content) {
                                contentEl.innerHTML = data.content;
                                contentEl.classList.remove('update-highlight');
                                void contentEl.offsetWidth; // Trigger reflow
                                contentEl.classList.add('update-highlight');
                            }
                        
                            lastUpdated = data.updated_at;
                        }
                    })
                    .catch(error => console.error('Error polling for updates:', error));
            }

            // Poll every 5 seconds
            setInterval(checkUpdates, 5000);
        </script>
    </body>
</html>
