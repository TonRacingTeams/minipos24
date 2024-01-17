import { createWebHistory, createRouter } from "vue-router";

import Home from '../Pages/Home.vue';
import Pos from '../Pages/Pos.vue';
import Report from '../Pages/Report.vue';
import Store from '../Pages/Store.vue';
import Transection from '../Pages/Transection.vue';
import No_page from '../Pages/No_page.vue';


export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'pos',
        path: '/pos',
        component: Pos
    },
    {
        name: 'report',
        path: '/report',
        component: Report
    },
    {
        name: 'store',
        path: '/store',
        component: Store
    },
    {
        name: 'transection',
        path: '/transection',
        component: Transection
    },
    {
        name: 'no_page',
        path: '/no_page',
        component: No_page
    },
];

const router  = createRouter({
    history: createWebHistory(),
    routes: routes,
    scrollBehavior(){
        window.scrollTo(0,0)
    }
});

export default router;