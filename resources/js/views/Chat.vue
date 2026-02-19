<template>
    <div class="w-full max-w-4xl mx-auto px-6 py-12">
        <div class="bg-white dark:bg-gray-800 rounded-[3rem] p-8 md:p-12 shadow-2xl border border-gray-100 dark:border-gray-700 flex flex-col h-[700px]">
            <h1 class="text-4xl font-black mb-8 text-gray-900 dark:text-white">Real-time Chat</h1>
            
            <!-- Messages Area -->
            <div ref="messageContainer" class="flex-grow overflow-y-auto mb-8 space-y-4 pr-4 custom-scrollbar">
                <div v-for="(msg, index) in messages" :key="index" 
                    :class="[
                        'p-4 rounded-2xl max-w-[80%] shadow-sm transition-all animate-fade-in',
                        msg.username === username ? 'ml-auto bg-red-500 text-white rounded-tr-none' : 'bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 rounded-tl-none'
                    ]">
                    <div class="text-xs font-black uppercase tracking-widest mb-1 opacity-70">
                        {{ msg.username }}
                    </div>
                    <div class="text-lg font-medium leading-relaxed">
                        {{ msg.message }}
                    </div>
                </div>
                <div v-if="messages.length === 0" class="h-full flex items-center justify-center text-gray-400 font-bold italic">
                    No messages yet. Start the conversation!
                </div>
            </div>

            <!-- Input Area -->
            <div class="space-y-4">
                <div v-if="!usernameSet" class="flex space-x-4">
                    <input v-model="tempUsername" type="text" placeholder="Enter your name..." 
                        class="flex-grow px-6 py-4 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl focus:ring-2 focus:ring-red-500 transition-all font-bold text-lg"
                        @keyup.enter="setUsername">
                    <button @click="setUsername" class="bg-red-500 text-white px-8 py-4 rounded-full font-black hover:bg-red-600 transition-all shadow-xl shadow-red-500/20 active:transform active:scale-95">
                        Join
                    </button>
                </div>
                <form v-else @submit.prevent="sendMessage" class="flex space-x-4">
                    <input v-model="newMessage" type="text" placeholder="Type a message..." 
                        class="flex-grow px-6 py-4 bg-gray-50 dark:bg-gray-900 border-none rounded-2xl focus:ring-2 focus:ring-red-500 transition-all font-medium text-lg"
                        required>
                    <button type="submit" class="bg-red-500 text-white p-4 rounded-full font-black hover:bg-red-600 transition-all shadow-xl shadow-red-500/20 active:transform active:scale-95 flex items-center justify-center">
                        <svg class="w-6 h-6 transform rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, nextTick } from 'vue';
import axios from 'axios';

const messages = ref([]);
const newMessage = ref('');
const username = ref(localStorage.getItem('chat_username') || '');
const tempUsername = ref('');
const usernameSet = ref(!!username.value);
const messageContainer = ref(null);

const setUsername = () => {
    if (tempUsername.value.trim()) {
        username.value = tempUsername.value.trim();
        localStorage.setItem('chat_username', username.value);
        usernameSet.value = true;
    }
};

const sendMessage = async () => {
    if (!newMessage.value.trim()) return;

    const messageData = {
        username: username.value,
        message: newMessage.value
    };

    // Add to local list immediately
    messages.value.push(messageData);
    scrollToBottom();

    const text = newMessage.value;
    newMessage.value = '';

    try {
        await axios.post('/chat/message', {
            username: username.value,
            message: text
        });
    } catch (error) {
        console.error('Failed to send message:', error);
    }
};

const scrollToBottom = () => {
    nextTick(() => {
        if (messageContainer.value) {
            messageContainer.value.scrollTop = messageContainer.value.scrollHeight;
        }
    });
};

onMounted(() => {
    if (window.Echo) {
        window.Echo.channel('chat')
            .listen('ChatMessageSent', (e) => {
                messages.value.push({
                    username: e.username,
                    message: e.message
                });
                scrollToBottom();
            });
    }
});

onUnmounted(() => {
    if (window.Echo) {
        window.Echo.leaveChannel('chat');
    }
});
</script>

<style scoped>
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
}
.custom-scrollbar::-webkit-scrollbar-track {
    background: transparent;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #e2e8f0;
    border-radius: 10px;
}
.dark .custom-scrollbar::-webkit-scrollbar-thumb {
    background: #374151;
}
@keyframes fade-in {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in {
    animation: fade-in 0.3s ease-out forwards;
}
</style>
