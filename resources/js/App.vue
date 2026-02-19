<template>
    <div class="relative min-h-screen flex flex-col selection:bg-red-500 selection:text-white bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
        <nav class="w-full max-w-7xl mx-auto p-6 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <router-link to="/" class="text-2xl font-bold text-gray-900 dark:text-white hover:text-red-500 transition-colors">
                    Laravel<span class="text-red-500">Blog</span>
                </router-link>
            </div>
            <div class="flex items-center space-x-6">
                <router-link to="/" class="font-semibold hover:text-red-500 transition-colors" exact-active-class="text-red-500 underline decoration-2 underline-offset-4">Home</router-link>
                <router-link to="/blog" class="font-semibold hover:text-red-500 transition-colors" active-class="text-red-500 underline decoration-2 underline-offset-4">Blog</router-link>
                <router-link to="/chat" class="font-semibold hover:text-red-500 transition-colors" active-class="text-red-500 underline decoration-2 underline-offset-4">Chat</router-link>
                <router-link to="/about" class="font-semibold hover:text-red-500 transition-colors" active-class="text-red-500 underline decoration-2 underline-offset-4">About</router-link>
            </div>
        </nav>

        <main class="flex-grow">
            <router-view></router-view>
        </main>

        <footer class="w-full max-w-7xl mx-auto p-6 mt-auto border-t border-gray-200 dark:border-gray-800 flex flex-col sm:flex-row justify-between items-center text-sm text-gray-500">
            <p>&copy; 2024 Laravel Blog. Built with Laravel and Vue.</p>
            <div class="flex space-x-4 mt-4 sm:mt-0">
                <router-link to="/" class="hover:text-red-500 transition-colors">Home</router-link>
                <router-link to="/blog" class="hover:text-red-500 transition-colors">Blog</router-link>
                <router-link to="/chat" class="hover:text-red-500 transition-colors">Chat</router-link>
                <router-link to="/about" class="hover:text-red-500 transition-colors">About</router-link>
            </div>
        </footer>
    </div>
</template>

<script setup>
</script>

<style>
@keyframes highlight {
    0% { background-color: rgba(239, 68, 68, 0.2); }
    100% { background-color: transparent; }
}
.update-highlight {
    animation: highlight 2s ease-out;
}
</style>
