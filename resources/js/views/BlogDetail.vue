<template>
    <div v-if="error" class="w-full max-w-4xl mx-auto px-6 py-12">
        <div class="bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-3xl shadow-sm mb-8 flex items-center">
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="font-bold">{{ error }}</span>
        </div>
        <router-link to="/blog" class="text-gray-500 hover:text-red-500 font-bold transition-colors inline-flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Blog
        </router-link>
    </div>

    <div v-else-if="blog" class="w-full max-w-4xl mx-auto px-6 py-12">
        <div class="mb-12 flex justify-between items-center">
            <router-link to="/blog" class="group text-gray-500 hover:text-red-500 font-bold transition-colors inline-flex items-center">
                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Back to Blog
            </router-link>

            <router-link :to="'/blog/' + blog.id + '/edit'" class="bg-gray-900 dark:bg-white text-white dark:text-gray-900 px-8 py-3 rounded-full font-black hover:bg-red-500 hover:text-white dark:hover:bg-red-500 dark:hover:text-white transition-all shadow-xl active:transform active:scale-95 flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                Edit Post
            </router-link>
        </div>

        <article>
            <header class="mb-12">
                <div class="relative h-[400px] md:h-[500px] w-full mb-12 rounded-[3rem] overflow-hidden shadow-2xl">
                    <img :src="blog.image_url" :alt="blog.title" class="absolute inset-0 w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 via-transparent to-transparent"></div>
                </div>
                <div class="flex items-center space-x-3 text-red-500 mb-6 text-sm font-bold uppercase tracking-widest">
                    <span>Article</span>
                    <span>&bull;</span>
                    <time>{{ formatDate(blog.created_at) }}</time>
                </div>
                <h1 :class="{'update-highlight': titleUpdated}" class="text-5xl md:text-6xl font-black tracking-tight mb-8 text-gray-900 dark:text-white leading-[1.1]">
                    {{ blog.title }}
                </h1>
                <router-link :to="'/users/' + blog.user.id" class="flex items-center p-6 bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-xl hover:border-red-500 transition-all duration-300 group/author">
                    <div class="h-12 w-12 bg-red-500 rounded-2xl flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-red-500/20 mr-4 group-hover/author:scale-110 transition-transform">
                        {{ blog.user.name.substring(0, 1) }}
                    </div>
                    <div>
                        <p class="text-sm text-gray-900 dark:text-white font-bold uppercase tracking-wider mb-1">Written by</p>
                        <p class="font-black text-gray-900 dark:text-white text-lg leading-none group-hover/author:text-red-500 transition-colors">{{ blog.user.name }}</p>
                    </div>
                </router-link>
            </header>

            <div :class="{'update-highlight': contentUpdated}" class="prose prose-xl dark:prose-invert max-w-none text-gray-700 dark:text-gray-300 leading-relaxed space-y-8 text-xl" v-html="formattedContent">
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
    </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { useRoute } from 'vue-router';
import { useBlogStore } from '../stores/blogStore';
import { storeToRefs } from 'pinia';

const route = useRoute();
const store = useBlogStore();
const { currentBlog: blog, error, formattedContent } = storeToRefs(store);

const titleUpdated = ref(false);
const contentUpdated = ref(false);
let pollInterval = null;

const checkUpdates = async () => {
    const updated = await store.checkUpdates(route.params.id);
    if (updated === 'title' || updated === 'both') {
        titleUpdated.value = true;
        setTimeout(() => titleUpdated.value = false, 2000);
    }
    if (updated === 'content' || updated === 'both') {
        contentUpdated.value = true;
        setTimeout(() => contentUpdated.value = false, 2000);
    }
};

const formatDate = (dateString) => {
    const options = { year: 'numeric', month: 'short', day: 'numeric' };
    return new Date(dateString).toLocaleDateString(undefined, options);
};

onMounted(() => {
    store.fetchBlog(route.params.id);
    pollInterval = setInterval(checkUpdates, 5000);
});

onUnmounted(() => {
    if (pollInterval) clearInterval(pollInterval);
});
</script>
