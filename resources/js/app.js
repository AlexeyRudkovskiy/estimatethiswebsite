require('./bootstrap');

window.Vue = require('vue').default;

import router from './router';
import App from "./modules/layout/App";

const app = new Vue({
    router,
    el: '#app',
    render: h => h(App)
});

