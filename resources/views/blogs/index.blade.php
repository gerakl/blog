<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Blog - Laravel Blog</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Figtree', sans-serif;
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

        <main class="flex-grow w-full max-w-7xl mx-auto px-6 py-12">
            <header class="mb-16 text-center">
                <h1 class="text-6xl font-extrabold tracking-tight mb-4 text-gray-900 dark:text-white">
                    Our <span class="text-red-500">Blog1</span>
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto leading-relaxed">
                    Insights, tutorials, and stories from the Laravel ecosystem.
                </p>
            </header>

            @if($blogs->onFirstPage() && $blogs->count() > 0)
                @php $featured = $blogs->first(); @endphp
                <section class="mb-16">
                    <div class="block relative group/featured overflow-hidden rounded-3xl bg-gray-900 aspect-[21/9] flex items-end">
                        {{-- Full-card blog link overlay (avoids nested <a>) --}}
                        <a href="{{ route('blog.show', $featured) }}" class="absolute inset-0 z-10" aria-label="Read: {{ $featured->title }}"></a>

                        <div class="absolute inset-0 group/image z-0 pointer-events-none">
                            <img src="{{ $featured->image_url }}" alt="{{ $featured->title }}" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover/image:scale-105 transition-transform duration-700">
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent z-20 pointer-events-none"></div>
                        <div class="absolute inset-0 bg-red-500/10 group-hover/featured:bg-red-500/20 transition-colors duration-500 z-20 pointer-events-none"></div>

                        <div class="relative z-30 p-8 md:p-12 w-full pointer-events-none">
                            <div class="flex items-center space-x-3 text-red-400 mb-4 text-sm font-bold uppercase tracking-widest">
                                <span>Featured Post</span>
                                <span>&bull;</span>
                                <time>{{ $featured->created_at->format('M d, Y') }}</time>
                            </div>
                            <h2 class="text-3xl md:text-5xl font-black text-white mb-4">
                                {{ $featured->title }}
                            </h2>
                            <p class="text-gray-300 text-lg max-w-3xl mb-6 line-clamp-2">
                                {{ Str::limit($featured->content, 200) }}
                            </p>
                            <div class="flex items-center justify-between">
                                <a href="{{ route('user.show', $featured->user) }}" class="flex items-center space-x-3 hover:opacity-80 transition-opacity pointer-events-auto">
                                    <div class="h-10 w-10 bg-red-500 rounded-full flex items-center justify-center text-white font-bold">
                                        {{ substr($featured->user->name, 0, 1) }}
                                    </div>
                                    <span class="text-white font-semibold hover:underline">{{ $featured->user->name }}</span>
                                </a>
                                <div class="bg-white text-gray-900 px-8 py-3 rounded-full font-bold hover:bg-red-500 hover:text-white transition-all duration-300 transform group-hover/featured:scale-105">
                                    Read Article
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                @foreach ($blogs as $blog)
                    @if($blogs->onFirstPage() && $loop->first)
                        @continue
                    @endif
                    <article class="group/card bg-white dark:bg-gray-800 rounded-3xl overflow-hidden shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-2xl hover:shadow-red-500/10 transition-all duration-300 flex flex-col">
                        <a href="{{ route('blog.show', $blog) }}" class="h-64 bg-gray-100 dark:bg-gray-700 relative overflow-hidden block group/image">
                            <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" class="absolute inset-0 w-full h-full object-cover group-hover/image:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-br from-red-500/20 to-transparent"></div>
                        </a>
                        <div class="p-8 flex flex-col flex-grow">
                            <div class="flex items-center justify-between mb-4">
                                <a href="{{ route('user.show', $blog->user) }}" class="text-xs font-bold uppercase tracking-widest text-gray-900 dark:text-white hover:text-red-500 hover:underline transition-colors">{{ $blog->user->name }}</a>
                                <time class="text-xs text-gray-400 dark:text-gray-500 font-medium">{{ $blog->created_at->format('M d, Y') }}</time>
                            </div>
                            <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white group/title transition-colors duration-300">
                                <a href="{{ route('blog.show', $blog) }}" class="group-hover/title:text-red-500">
                                    {{ $blog->title }}
                                </a>
                            </h2>
                            <p class="text-gray-600 dark:text-gray-400 leading-relaxed mb-6 flex-grow line-clamp-3">
                                {{ Str::limit($blog->content, 150) }}
                            </p>
                            <div class="flex items-center justify-between mt-auto pt-6 border-t border-gray-50 dark:border-gray-700">
                                <a href="{{ route('blog.show', $blog) }}" class="text-gray-900 dark:text-white font-bold inline-flex items-center group/link">
                                    <span class="hover:text-red-500 group-hover/title:text-red-500 transition-all duration-300">Read more</span>
                                    <svg class="w-4 h-4 ml-2 text-red-500 transform group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $blogs->links() }}
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
</body>
</html>