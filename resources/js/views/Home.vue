<template>
    <div class="w-full max-w-7xl mx-auto px-6 py-12">
        <div class="relative bg-gray-900 rounded-[3.5rem] overflow-hidden mb-16 shadow-2xl">
            <div class="absolute inset-0 opacity-20 bg-[url('https://images.unsplash.com/photo-1499750310107-5fef28a66643?auto=format&fit=crop&q=80&w=2070')] bg-cover bg-center"></div>
            <div class="relative z-10 px-8 py-24 md:p-24 text-center">
                <h1 class="text-5xl md:text-8xl font-black text-white mb-8 tracking-tighter">
                    Welcome to <span class="text-red-500">Laravel Blog</span>
                </h1>
                <p class="text-xl md:text-2xl text-gray-300 max-w-3xl mx-auto mb-12 font-medium leading-relaxed">
                    A modern editorial space where we share insights on development, design, and everything in between.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <router-link to="/blog" class="bg-red-500 text-white px-10 py-5 rounded-full font-black text-lg hover:bg-red-600 transition-all shadow-xl shadow-red-500/20 active:transform active:scale-95">
                        Start Reading
                    </router-link>
                    <router-link to="/about" class="bg-white text-gray-900 px-10 py-5 rounded-full font-black text-lg hover:bg-gray-100 transition-all shadow-xl active:transform active:scale-95">
                        Our Mission
                    </router-link>
                </div>
            </div>
        </div>

        <!-- Featured Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-24">
            <div class="bg-white dark:bg-gray-800 p-10 rounded-[2.5rem] border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-xl transition-all group">
                <div class="w-14 h-14 bg-red-50 dark:bg-red-900/20 rounded-2xl flex items-center justify-center text-red-500 mb-8 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <h3 class="text-2xl font-black mb-4 text-gray-900 dark:text-white">Editorial Content</h3>
                <p class="text-gray-500 dark:text-gray-400 font-medium leading-relaxed">High-quality articles written by experts in their respective fields.</p>
            </div>
            <div class="bg-white dark:bg-gray-800 p-10 rounded-[2.5rem] border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-xl transition-all group">
                <div class="w-14 h-14 bg-blue-50 dark:bg-blue-900/20 rounded-2xl flex items-center justify-center text-blue-500 mb-8 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h3 class="text-2xl font-black mb-4 text-gray-900 dark:text-white">Fast Experience</h3>
                <p class="text-gray-500 dark:text-gray-400 font-medium leading-relaxed">Built with Laravel and Vue for lightning-fast navigation and real-time updates.</p>
            </div>
            <div class="bg-white dark:bg-gray-800 p-10 rounded-[2.5rem] border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-xl transition-all group">
                <div class="w-14 h-14 bg-purple-50 dark:bg-purple-900/20 rounded-2xl flex items-center justify-center text-purple-500 mb-8 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <h3 class="text-2xl font-black mb-4 text-gray-900 dark:text-white">Community Driven</h3>
                <p class="text-gray-500 dark:text-gray-400 font-medium leading-relaxed">A growing community of developers sharing knowledge and building together.</p>
            </div>
        </div>
    </div>
</template>

<script setup>
</script>
