import './bootstrap';

import { createApp } from 'vue';

import App from './App.vue';

import router from './router/index.js';

import MenuSidebar from './Components/MenuSidebar.vue';

import{createPinia} from 'pinia'
const pania = createPinia();

const app = createApp(App);
app.component('MenuSidebar', MenuSidebar)
app.use(router)
app.use(pania)
app.mount('#app-vue');

