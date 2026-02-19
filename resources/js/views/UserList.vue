<template>
    <div class="w-full max-w-7xl mx-auto px-6 py-12">
        <!-- Section Title -->
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-4xl font-black text-gray-900 dark:text-white mb-2">Users</h2>
                <div class="h-1.5 w-20 bg-red-500 rounded-full"></div>
            </div>
        </div>

        <!-- Users Grid -->
        <div v-if="users.data && users.data.length" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <router-link 
                v-for="user in users.data" 
                :key="user.id"
                :to="'/users/' + user.id"
                class="group/card bg-white dark:bg-gray-800 rounded-[2rem] overflow-hidden border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-2xl transition-all duration-500 p-8 flex flex-col items-center text-center"
            >
                <div class="h-24 w-24 bg-gradient-to-br from-red-500 to-red-600 rounded-3xl flex items-center justify-center text-white font-black text-4xl shadow-lg shadow-red-500/30 mb-6 group-hover/card:scale-110 transition-transform duration-500">
                    {{ user.name.substring(0, 1).toUpperCase() }}
                </div>
                <h3 class="text-2xl font-black text-gray-900 dark:text-white group-hover/card:text-red-500 transition-colors mb-2">
                    {{ user.name }}
                </h3>
                <p class="text-gray-600 dark:text-gray-400 mb-4 break-all">
                    {{ user.email }}
                </p>
                <div class="mt-auto pt-4 border-t border-gray-100 dark:border-gray-700 w-full">
                    <div class="flex items-center justify-center text-sm font-bold text-gray-500 dark:text-gray-400">
                        <svg class="w-4 h-4 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        {{ user.blogs_count }} {{ user.blogs_count === 1 ? 'Post' : 'Posts' }}
                    </div>
                </div>
            </router-link>
        </div>

        <!-- Empty State -->
        <div v-else class="text-center py-20">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 dark:bg-gray-800 rounded-full mb-6">
                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">No users found</h3>
            <p class="text-gray-600 dark:text-gray-400">There are no users to display.</p>
        </div>

        <!-- Pagination -->
        <div v-if="users.links && users.links.length > 3" class="mt-20 flex justify-center">
            <nav class="inline-flex space-x-2">
                <button 
                    v-for="(link, index) in users.links" 
                    :key="index"
                    @click="fetchUsers(link.url)"
                    :disabled="!link.url || link.active"
                    class="px-6 py-3 rounded-2xl font-bold transition-all"
                    :class="[
                        link.active ? 'bg-red-500 text-white shadow-lg shadow-red-500/30' : 'bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-400 hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-500',
                        !link.url && !link.active ? 'opacity-50 cursor-not-allowed' : ''
                    ]"
                    v-html="link.label"
                ></button>
            </nav>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const users = ref({ data: [], links: [] });

const fetchUsers = async (url = '/users') => {
    try {
        const response = await axios.get(url);
        users.value = response.data;
    } catch (error) {
        console.error('Error fetching users:', error);
    }
};

onMounted(() => {
    fetchUsers();
});
</script>
