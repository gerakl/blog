import { createRouter, createWebHistory } from 'vue-router';
import Home from './views/Home.vue';
import BlogList from './views/BlogList.vue';
import BlogDetail from './views/BlogDetail.vue';
import EditBlog from './views/EditBlog.vue';
import About from './views/About.vue';
import Chat from './views/Chat.vue';
import UserList from './views/UserList.vue';
import UserDetail from './views/UserDetail.vue';

const routes = [
    { path: '/', component: Home },
    { path: '/blog', component: BlogList },
    { path: '/blog/:id', component: BlogDetail },
    { path: '/blog/:id/edit', component: EditBlog },
    { path: '/users', component: UserList },
    { path: '/users/:id', component: UserDetail },
    { path: '/about', component: About },
    { path: '/chat', component: Chat },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
