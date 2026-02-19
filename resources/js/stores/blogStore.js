import { defineStore } from 'pinia';
import axios from 'axios';

export const useBlogStore = defineStore('blog', {
    state: () => ({
        blogs: { data: [], links: [] },
        currentBlog: null,
        formattedContent: '',
        loading: false,
        error: null,
        lastUpdated: ''
    }),

    getters: {
        featuredBlog: (state) => {
            if (state.blogs.current_page === 1 && state.blogs.data.length > 0) {
                return state.blogs.data[0];
            }
            return null;
        }
    },

    actions: {
        async fetchBlogs(url = '/blog') {
            this.loading = true;
            this.error = null;
            try {
                const response = await axios.get(url, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
                });
                this.blogs = response.data;
                window.scrollTo({ top: 0, behavior: 'smooth' });
            } catch (error) {
                console.error('Error fetching blogs:', error);
                this.error = 'Failed to load blogs.';
            } finally {
                this.loading = false;
            }
        },

        async fetchBlog(id) {
            this.loading = true;
            this.error = null;
            this.currentBlog = null;
            try {
                const response = await axios.get(`/blog/${id}`, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
                });
                if (response.data && response.data.blog) {
                    this.currentBlog = response.data.blog;
                    this.formattedContent = response.data.formatted_content;
                    this.lastUpdated = this.currentBlog.updated_at;
                } else {
                    this.error = 'Failed to load blog post.';
                }
            } catch (err) {
                console.error('Error fetching blog:', err);
                if (err.response && err.response.status === 404) {
                    this.error = 'Blog post not found.';
                } else {
                    this.error = 'An error occurred while fetching the blog post.';
                }
            } finally {
                this.loading = false;
            }
        },

        async checkUpdates(id) {
            try {
                const response = await axios.get(`/blog/${id}/data`);
                const data = response.data;
                
                let updated = false;
                if (data.updated_at !== this.lastUpdated) {
                    if (this.currentBlog.title !== data.title) {
                        this.currentBlog.title = data.title;
                        updated = 'title';
                    }
                    if (this.formattedContent !== data.content) {
                        this.formattedContent = data.content;
                        updated = updated === 'title' ? 'both' : 'content';
                    }
                    this.lastUpdated = data.updated_at;
                }
                return updated;
            } catch (error) {
                console.error('Error checking updates:', error);
                return false;
            }
        },

        async updateBlog(id, formData) {
            this.loading = true;
            try {
                const response = await axios.put(`/blog/${id}`, formData, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
                });
                return { success: true, message: response.data.message };
            } catch (error) {
                if (error.response && error.response.status === 422) {
                    return { success: false, errors: error.response.data.errors };
                }
                console.error('Error updating blog:', error);
                return { success: false, message: 'An error occurred.' };
            } finally {
                this.loading = false;
            }
        }
    }
});
