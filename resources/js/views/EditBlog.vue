<template>
    <div v-if="blog" class="w-full max-w-4xl mx-auto px-6 py-12">
        <div class="mb-12">
            <router-link :to="'/blog/' + blog.id" class="group text-gray-500 hover:text-red-500 font-bold transition-colors inline-flex items-center">
                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Back to Post
            </router-link>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-[3rem] p-8 md:p-12 shadow-2xl border border-gray-100 dark:border-gray-700">
            <h1 class="text-4xl font-black mb-8 text-gray-900 dark:text-white">Edit Post</h1>
            
            <div v-if="successMessage" class="mb-8 p-4 bg-green-100 border border-green-400 text-green-700 rounded-2xl shadow-sm flex items-center">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ successMessage }}
            </div>

            <form @submit.prevent="updateBlog" class="space-y-8">
                <div>
                    <label class="block text-sm font-black uppercase tracking-widest text-gray-400 mb-2">Title</label>
                    <input v-model="form.title" type="text" class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl focus:ring-2 focus:ring-red-500 transition-all font-bold text-lg" required>
                    <p v-if="errors.title" class="mt-2 text-sm text-red-500 font-bold">{{ errors.title[0] }}</p>
                </div>

                <div>
                    <label class="block text-sm font-black uppercase tracking-widest text-gray-400 mb-2">Content</label>
                    <textarea v-model="form.content" rows="12" class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl focus:ring-2 focus:ring-red-500 transition-all font-medium text-lg leading-relaxed" required></textarea>
                    <p v-if="errors.content" class="mt-2 text-sm text-red-500 font-bold">{{ errors.content[0] }}</p>
                </div>

                <div class="flex items-center space-x-4">
                    <button type="submit" :disabled="isSubmitting" class="bg-red-500 text-white px-10 py-4 rounded-full font-black hover:bg-red-600 transition-all shadow-xl shadow-red-500/20 active:transform active:scale-95 disabled:opacity-50">
                        {{ isSubmitting ? 'Updating...' : 'Update Post' }}
                    </button>
                    <router-link :to="'/blog/' + blog.id" class="text-gray-500 hover:text-gray-700 font-bold transition-colors">
                        Cancel
                    </router-link>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { useBlogStore } from '../stores/blogStore';
import { storeToRefs } from 'pinia';

const route = useRoute();
const router = useRouter();
const store = useBlogStore();
const { currentBlog: blog, loading: isSubmitting } = storeToRefs(store);

const form = ref({ title: '', content: '' });
const errors = ref({});
const successMessage = ref('');

const initForm = async () => {
    await store.fetchBlog(route.params.id);
    if (blog.value) {
        form.value.title = blog.value.title;
        form.value.content = blog.value.content;
    }
};

const updateBlog = async () => {
    errors.value = {};
    const result = await store.updateBlog(route.params.id, form.value);
    
    if (result.success) {
        successMessage.value = result.message;
        setTimeout(() => {
            router.push(`/blog/${blog.value.id}`);
        }, 1500);
    } else if (result.errors) {
        errors.value = result.errors;
    }
};

onMounted(initForm);
</script>
