import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Home from './pages/Home';
import Categories from './pages/Categories';
import Post from './pages/Post';
import Contact from './pages/Contact';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/categories',
            name: 'categories',
            component: Categories
        },
        {
            path: '/contact-us',
            name: 'contact-us',
            component: Contact
        },
        {
            path: '/post/:slug',
            name: 'post',
            component: Post
        }
    ]
});

export default router;