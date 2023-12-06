import './bootstrap';

import { createApp } from 'vue';

import app from './components/app.vue';

import router from './router/index.js';

import pagination from './components/paginations.vue';

createApp(app).use(router).use(pagination).mount('#amortizations');

