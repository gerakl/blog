<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Edit: {{ $blog->title }} - Laravel Blog</title>

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
                <a href="/about" class="font-semibold hover:text-red-500 transition-colors">About</a>
            </div>
        </nav>

        <main class="flex-grow w-full max-w-4xl mx-auto px-6 py-12">
            <div class="mb-8">
                <a href="{{ route('blog.show', $blog) }}" class="text-red-500 font-semibold hover:text-red-600 transition-colors inline-flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    Back to Post
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                <h1 class="text-3xl font-bold mb-8 text-gray-900 dark:text-white">Edit Blog Post</h1>

                <form action="{{ route('blog.update', $blog) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $blog->title) }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all outline-none" required>
                        @error('title')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-8">
                        <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Content</label>
                        <textarea name="content" id="content" rows="12" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all outline-none leading-relaxed" required>{{ old('content', $blog->content) }}</textarea>
                        @error('content')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end space-x-4">
                        <a href="{{ route('blog.show', $blog) }}" class="text-gray-600 dark:text-gray-400 font-semibold hover:text-gray-900 dark:hover:text-white transition-colors">Cancel</a>
                        <button type="submit" class="bg-red-500 text-white px-8 py-3 rounded-xl font-bold hover:bg-red-600 transition-all shadow-lg shadow-red-500/20 active:transform active:scale-95">
                            Update Post
                        </button>
                    </div>
                </form>
            </div>
        </main>

        <footer class="w-full max-w-7xl mx-auto p-6 mt-auto border-t border-gray-200 dark:border-gray-800 flex flex-col sm:flex-row justify-between items-center text-sm text-gray-500">
            <p>&copy; 2024 Laravel Blog. Built with Laravel v{{ Illuminate\Foundation\Application::VERSION }}.</p>
            <div class="flex space-x-4 mt-4 sm:mt-0">
                <a href="/" class="hover:text-red-500 transition-colors">Home</a>
                <a href="/blog" class="hover:text-red-500 transition-colors text-red-500">Blog</a>
                <a href="/about" class="hover:text-red-500 transition-colors">About</a>
            </div>
        </footer>
    </div>
</body>
</html>
