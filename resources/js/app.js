import './bootstrap';

import { createApp } from 'vue';

import App from './App.vue';

import router from './router/index.js';

import MenuSidebar from './Components/MenuSidebar.vue';

import{createPinia} from 'pinia'
const pania = createPinia();

import Pagination from './Components/Pagination.vue';

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import Cleave from 'vue-cleave-component';

const app = createApp(App);
app.use(Cleave)
app.component('MenuSidebar', MenuSidebar)
app.use(VueSweetalert2)
app.component('Pagination', Pagination)
app.use(router)
app.use(pania)
app.mount('#app-vue');

