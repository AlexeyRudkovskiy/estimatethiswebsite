import Vue from 'vue';
import VueRouter from 'vue-router';

import IndexComponent from "./modules/home/IndexComponent";
import secondRoutes from "./modules/second/routes"

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
            name: 'home',
            component: IndexComponent
        },
        ...secondRoutes
    ]
});

export default router;
