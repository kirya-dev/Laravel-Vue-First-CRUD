
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';

window.Vue.use(VueRouter);

import BooksIndex from './components/books/Index.vue';
import BooksForm from './components/books/Form.vue';

import AuthorsIndex from './components/authors/Index.vue';
import AuthorsForm from './components/authors/Form.vue';

import AuthorTypesIndex from './components/author-types/Index.vue';
import AuthorTypesForm from './components/author-types/Form.vue';

const routerWrapper = { name: 'router-wrapper', template: `<router-view></router-view>` };

const routes = [
    {
        path: '/admin',
        redirect: {name: 'indexBook'}
    },
    {
        path: '/admin/books',
        component: routerWrapper,
        children: [
            { path: '', component: BooksIndex, name: 'indexBook' },
            { path: 'create', component: BooksForm, name: 'createBook' },
            { path: 'edit/:id', component: BooksForm, name: 'editBook' },
        ]
    },
    {
        path: '/admin/authors',
        component: routerWrapper,
        children: [
            { path: '', component: AuthorsIndex, name: 'indexAuthor' },
            { path: 'create', component: AuthorsForm, name: 'createAuthor' },
            { path: 'edit/:id', component: AuthorsForm, name: 'editAuthor' },
        ]
    },
    {
        path: '/admin/author-types',
        component: routerWrapper,
        children: [
            { path: '', component: AuthorTypesIndex, name: 'indexAuthorType' },
            { path: 'create', component: AuthorTypesForm, name: 'createAuthorType' },
            { path: 'edit/:id', component: AuthorTypesForm, name: 'editAuthorType' },
        ]
    },
];

const router = new VueRouter({ routes, mode: 'history' });

const app = new Vue({ router }).$mount('#app');
