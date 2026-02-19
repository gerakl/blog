<template>
    <div class="w-full max-w-7xl mx-auto px-6 py-12">
        <!-- Featured Post (only on first page) -->
        <div v-if="blogs.current_page === 1 && featuredBlog" class="mb-16">
            <!-- NOTE: no nested <router-link> inside <router-link> (invalid HTML) -->
            <div class="group/featured block relative h-[500px] rounded-[3rem] overflow-hidden shadow-2xl transition-transform duration-500 hover:scale-[1.01]">
                <!-- Full-card blog link overlay -->
                <router-link :to="'/blog/' + featuredBlog.id" class="absolute inset-0 z-10" :aria-label="`Read: ${featuredBlog.title}`">
                    <span class="sr-only">{{ featuredBlog.title }}</span>
                </router-link>

                <!-- Background Image -->
                <img :src="featuredBlog.image_url" :alt="featuredBlog.title" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover/image:scale-110 z-0 pointer-events-none">
                <!-- Gradient Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent pointer-events-none z-20"></div>

                <!-- Content Overlay -->
                <div class="absolute bottom-0 left-0 right-0 p-12 z-30">
                    <div class="pointer-events-none">
                        <div class="flex items-center space-x-3 text-red-500 mb-6 text-sm font-bold uppercase tracking-widest">
                            <span class="bg-red-500 text-white px-3 py-1 rounded-lg">Featured</span>
                            <span>&bull;</span>
                            <span>{{ formatDate(featuredBlog.created_at) }}</span>
                        </div>
                        <h2 class="text-4xl md:text-6xl font-black text-white mb-6 leading-[1.1]">
                            {{ featuredBlog.title }}
                        </h2>
                        <p class="text-gray-300 text-lg mb-8 line-clamp-2 font-medium">
                            {{ featuredBlog.content.substring(0, 150) }}...
                        </p>
                    </div>
                    <div class="flex items-center justify-between pointer-events-auto">
                        <router-link :to="'/users/' + featuredBlog.user.id" @click.stop class="flex items-center space-x-3 hover:opacity-80 transition-opacity group/author">
                            <div class="h-10 w-10 bg-red-500 rounded-full flex items-center justify-center text-white font-bold group-hover/author:scale-110 transition-transform">
                                {{ featuredBlog.user.name.substring(0, 1) }}
                            </div>
                            <span class="text-white font-semibold group-hover/author:underline">{{ featuredBlog.user.name }}</span>
                        </router-link>
                        <div class="inline-flex items-center text-white font-bold group-hover/featured:translate-x-2 transition-transform pointer-events-none">
                            Read Article 
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section Title -->
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-4xl font-black text-gray-900 dark:text-white mb-2">Latest Stories</h2>
                <div class="h-1.5 w-20 bg-red-500 rounded-full"></div>
            </div>
        </div>

        <!-- Blog Grid -->
        <div v-if="regularBlogs && regularBlogs.length" class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <div v-for="blog in regularBlogs" :key="blog.id" class="group/card bg-white dark:bg-gray-800 rounded-[2.5rem] overflow-hidden border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-2xl transition-all duration-500 flex flex-col h-full">
                <router-link :to="'/blog/' + blog.id" class="relative h-64 overflow-hidden block group/image">
                    <img :src="blog.image_url" :alt="blog.title" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover/image:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 to-transparent opacity-0 group-hover/card:opacity-100 transition-opacity"></div>
                </router-link>
                <div class="p-8 flex flex-col flex-grow">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-bold text-gray-900 dark:text-white uppercase tracking-widest">{{ formatDate(blog.created_at) }}</span>
                        <router-link 
                            :to="'/users/' + blog.user.id"
                            @click.stop
                            class="flex items-center text-xs text-gray-900 dark:text-white font-bold hover:text-red-500 hover:underline transition-colors group/author"
                        >
                            <span class="w-6 h-6 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mr-2 text-gray-500 group-hover/author:bg-red-500 group-hover/author:text-white transition-colors">{{ blog.user.name.substring(0,1) }}</span>
                            {{ blog.user.name }}
                        </router-link>
                    </div>
                    <router-link :to="'/blog/' + blog.id" class="block group/title mb-4">
                        <h3 class="text-2xl font-black text-gray-900 dark:text-white group-hover/title:text-red-500 transition-colors leading-tight">
                            {{ blog.title }}
                        </h3>
                    </router-link>
                    <p class="text-gray-600 dark:text-gray-400 mb-8 line-clamp-3 leading-relaxed flex-grow">
                        {{ blog.content.substring(0, 150) }}...
                    </p>
                    <router-link :to="'/blog/' + blog.id" class="inline-flex items-center text-gray-900 dark:text-white font-black group/link">
                        <span class="hover:text-red-500 group-hover/title:text-red-500 transition-all duration-300">Read more</span>
                        <svg class="w-4 h-4 ml-2 text-red-500 transform group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </router-link>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div v-if="blogs.links && blogs.links.length > 3" class="mt-20 flex justify-center">
            <nav class="inline-flex space-x-2">
                <button 
                    v-for="(link, index) in blogs.links" 
                    :key="index"
                    @click="store.fetchBlogs(link.url)"
                    :disabled="!link.url || link.active"
                    class="px-6 py-3 rounded-2xl font-bold transition-all"
                    :class="[
                        link.active ? 'bg-red-500 text-white shadow-lg shadow-red-500/30' : 'bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-400 hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-500'
                    ]"
                    v-html="link.label"
                ></button>
            </nav>
        </div>
    </div>
</template>

<script setup>
import { onMounted, computed } from 'vue';
import { useBlogStore } from '../stores/blogStore';
import { storeToRefs } from 'pinia';

const store = useBlogStore();
const { blogs, featuredBlog } = storeToRefs(store);

const regularBlogs = computed(() => {
    if (!blogs.value.data || !blogs.value.data.length) return [];
    // On first page, exclude the featured blog (first item) from the regular list
    if (blogs.value.current_page === 1 && featuredBlog.value) {
        return blogs.value.data.slice(1);
    }
    return blogs.value.data;
});

const formatDate = (dateString) => {
    const options = { year: 'numeric', month: 'short', day: 'numeric' };
    return new Date(dateString).toLocaleDateString(undefined, options);
};

onMounted(() => {
    store.fetchBlogs();
});

</script>
