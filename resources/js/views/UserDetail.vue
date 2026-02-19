<template>
    <div v-if="error" class="w-full max-w-4xl mx-auto px-6 py-12">
        <div class="bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-3xl shadow-sm mb-8 flex items-center">
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="font-bold">{{ error }}</span>
        </div>
        <router-link to="/users" class="text-gray-500 hover:text-red-500 font-bold transition-colors inline-flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Users
        </router-link>
    </div>

    <div v-else-if="user" class="w-full max-w-4xl mx-auto px-6 py-12">
        <div class="mb-12">
            <router-link to="/users" class="group text-gray-500 hover:text-red-500 font-bold transition-colors inline-flex items-center">
                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Back to Users
            </router-link>
        </div>

        <!-- User Profile Card -->
        <div class="bg-white dark:bg-gray-800 rounded-[3rem] overflow-hidden border border-gray-100 dark:border-gray-700 shadow-xl mb-12">
            <div class="bg-gradient-to-br from-red-500 to-red-600 h-32"></div>
            <div class="px-12 pb-12">
                <div class="flex flex-col md:flex-row md:items-end md:justify-between -mt-16 mb-8">
                    <div class="flex items-end mb-6 md:mb-0">
                        <div class="h-32 w-32 bg-white dark:bg-gray-800 rounded-3xl flex items-center justify-center text-red-500 font-black text-6xl shadow-2xl border-4 border-white dark:border-gray-800">
                            {{ user.name.substring(0, 1).toUpperCase() }}
                        </div>
                    </div>
                    <button 
                        @click="showEditModal = true"
                        class="bg-gray-900 dark:bg-white text-white dark:text-gray-900 px-8 py-3 rounded-full font-black hover:bg-red-500 hover:text-white dark:hover:bg-red-500 dark:hover:text-white transition-all shadow-xl active:transform active:scale-95 flex items-center justify-center"
                    >
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        Update User
                    </button>
                </div>

                <div class="space-y-6">
                    <div>
                        <h1 class="text-5xl md:text-6xl font-black tracking-tight mb-4 text-gray-900 dark:text-white leading-[1.1]">
                            {{ user.name }}
                        </h1>
                        <p class="text-xl text-gray-600 dark:text-gray-400 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            {{ user.email }}
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-4">
                        <div class="bg-gray-50 dark:bg-gray-900 rounded-2xl px-6 py-4 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <div>
                                <p class="text-2xl font-black text-gray-900 dark:text-white">{{ user.blogs_count }}</p>
                                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Blog Posts</p>
                            </div>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-900 rounded-2xl px-6 py-4 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <div>
                                <p class="text-sm font-bold text-gray-900 dark:text-white">{{ formatDate(user.created_at) }}</p>
                                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Member Since</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- User's Blog Posts -->
        <div v-if="user.blogs && user.blogs.length > 0">
            <div class="mb-8">
                <h2 class="text-3xl font-black text-gray-900 dark:text-white mb-2">Blog Posts</h2>
                <div class="h-1.5 w-16 bg-red-500 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <router-link 
                    v-for="blog in user.blogs" 
                    :key="blog.id"
                    :to="'/blog/' + blog.id"
                    class="group/card bg-white dark:bg-gray-800 rounded-[2rem] overflow-hidden border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-2xl transition-all duration-500"
                >
                    <div class="relative h-48 overflow-hidden group/image">
                        <img :src="blog.image_url" :alt="blog.title" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover/image:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 to-transparent opacity-0 group-hover/card:opacity-100 transition-opacity"></div>
                    </div>
                    <div class="p-6">
                        <div class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest mb-3">
                            {{ formatDate(blog.created_at) }}
                        </div>
                        <h3 class="text-xl font-black text-gray-900 dark:text-white group-hover/card:text-red-500 transition-colors leading-tight mb-3">
                            {{ blog.title }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm line-clamp-2">
                            {{ blog.content.substring(0, 100) }}...
                        </p>
                    </div>
                </router-link>
            </div>
        </div>

        <div v-else class="text-center py-12 bg-gray-50 dark:bg-gray-800 rounded-3xl">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full mb-4">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">No blog posts yet</h3>
            <p class="text-gray-600 dark:text-gray-400">This user hasn't written any blog posts.</p>
        </div>
    </div>

    <!-- Edit Modal -->
    <div v-if="showEditModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4 z-50" @click.self="showEditModal = false">
        <div class="bg-white dark:bg-gray-800 rounded-[3rem] shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-12">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-4xl font-black text-gray-900 dark:text-white">Update User</h2>
                    <button @click="showEditModal = false" class="text-gray-500 hover:text-red-500 transition-colors">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form @submit.prevent="updateUser" class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-900 dark:text-white mb-3 uppercase tracking-wider">Name</label>
                        <input 
                            v-model="editForm.name" 
                            type="text" 
                            required
                            class="w-full px-6 py-4 rounded-2xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white font-bold focus:border-red-500 focus:outline-none transition-colors"
                            placeholder="Enter name"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-900 dark:text-white mb-3 uppercase tracking-wider">Email</label>
                        <input 
                            v-model="editForm.email" 
                            type="email" 
                            required
                            class="w-full px-6 py-4 rounded-2xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white font-bold focus:border-red-500 focus:outline-none transition-colors"
                            placeholder="Enter email"
                        >
                    </div>

                    <div v-if="updateError" class="bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-2xl flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-bold">{{ updateError }}</span>
                    </div>

                    <div v-if="updateSuccess" class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-2xl flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-bold">{{ updateSuccess }}</span>
                    </div>

                    <div class="flex space-x-4 pt-6">
                        <button 
                            type="submit" 
                            :disabled="isUpdating"
                            class="flex-1 bg-red-500 text-white px-8 py-4 rounded-full font-black hover:bg-red-600 transition-all shadow-xl active:transform active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            <span v-if="!isUpdating">Save Changes</span>
                            <span v-else>Updating...</span>
                        </button>
                        <button 
                            type="button" 
                            @click="showEditModal = false"
                            class="flex-1 bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white px-8 py-4 rounded-full font-black hover:bg-gray-300 dark:hover:bg-gray-600 transition-all"
                        >
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
import { useRoute } from 'vue-router';
import axios from 'axios';

const route = useRoute();
const user = ref(null);
const error = ref(null);
const showEditModal = ref(false);
const editForm = ref({ name: '', email: '' });
const isUpdating = ref(false);
const updateError = ref(null);
const updateSuccess = ref(null);

const formatDate = (dateString) => {
    const options = { year: 'numeric', month: 'short', day: 'numeric' };
    return new Date(dateString).toLocaleDateString(undefined, options);
};

const fetchUser = async () => {
    try {
        error.value = null;
        const response = await axios.get(`/users/${route.params.id}`);
        user.value = response.data.user;
        editForm.value = {
            name: user.value.name,
            email: user.value.email
        };
    } catch (err) {
        error.value = err.response?.data?.message || 'User not found';
    }
};

const updateUser = async () => {
    isUpdating.value = true;
    updateError.value = null;
    updateSuccess.value = null;

    try {
        const response = await axios.put(`/users/${route.params.id}`, editForm.value);
        user.value = response.data.user;
        updateSuccess.value = response.data.message;
        
        setTimeout(() => {
            showEditModal.value = false;
            updateSuccess.value = null;
        }, 2000);
    } catch (err) {
        updateError.value = err.response?.data?.message || 'Failed to update user';
    } finally {
        isUpdating.value = false;
    }
};

watch(showEditModal, (newVal) => {
    if (!newVal) {
        updateError.value = null;
        updateSuccess.value = null;
    }
});

onMounted(() => {
    fetchUser();
});
</script>
