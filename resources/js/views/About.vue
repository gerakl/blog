<template>
    <div class="w-full max-w-4xl mx-auto px-6 py-12">
        <header class="mb-16 text-center">
            <h1 class="text-6xl font-black text-gray-900 dark:text-white mb-6">About Our Blog</h1>
            <p class="text-xl text-gray-500 dark:text-gray-400 max-w-2xl mx-auto font-medium leading-relaxed">
                Discover the story behind Laravel Blog and our commitment to the developer community.
            </p>
        </header>

        <section class="mb-16 bg-white dark:bg-gray-800 p-12 rounded-[3rem] shadow-sm border border-gray-100 dark:border-gray-700">
            <h2 class="text-3xl font-black text-gray-900 dark:text-white mb-6">Our Mission</h2>
            <p class="text-lg text-gray-600 dark:text-gray-300 leading-relaxed mb-8">
                At Laravel Blog, our mission is to provide high-quality, accessible, and practical knowledge to developers of all skill levels. We believe in the power of open-source and the importance of sharing best practices to build a better web.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="flex items-start">
                    <div class="w-8 h-8 bg-red-500 rounded-lg flex-shrink-0 mr-4 mt-1"></div>
                    <p class="text-gray-600 dark:text-gray-400 font-bold uppercase tracking-wider">Quality First</p>
                </div>
                <div class="flex items-start">
                    <div class="w-8 h-8 bg-gray-900 dark:bg-white rounded-lg flex-shrink-0 mr-4 mt-1"></div>
                    <p class="text-gray-600 dark:text-gray-400 font-bold uppercase tracking-wider">Community Driven</p>
                </div>
            </div>
        </section>

        <section class="mb-16">
            <h2 class="text-3xl font-black text-gray-900 dark:text-white mb-12 text-center">What We Offer</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="p-8 bg-gray-50 dark:bg-gray-900 rounded-3xl">
                    <h3 class="text-xl font-black mb-4 text-red-500">Tutorials</h3>
                    <p class="text-gray-600 dark:text-gray-400">Step-by-step guides on Laravel, Vue, and modern web development.</p>
                </div>
                <div class="p-8 bg-gray-50 dark:bg-gray-900 rounded-3xl">
                    <h3 class="text-xl font-black mb-4 text-red-500">Best Practices</h3>
                    <p class="text-gray-600 dark:text-gray-400">Insights into writing clean, maintainable, and efficient code.</p>
                </div>
            </div>
        </section>

        <section class="p-12 bg-red-500 rounded-[3rem] text-center shadow-xl shadow-red-500/20">
            <h2 class="text-3xl font-black text-white mb-4">Join Our Journey</h2>
            <p class="text-red-50 max-w-md mx-auto mb-8 font-medium">Subscribe to our newsletter to stay updated with the latest articles and community news.</p>
            <button class="bg-white text-red-500 px-10 py-4 rounded-full font-black text-lg hover:bg-gray-100 transition-all shadow-lg active:transform active:scale-95">
                Subscribe Now
            </button>
        </section>
    </div>
</template>

<script setup>
</script>
