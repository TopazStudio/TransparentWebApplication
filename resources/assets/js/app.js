import Vue from 'vue';
import router from './Router';
import store from './Store';

try {
    window.$ = window.jQuery = require('jquery');
} catch (e) {}

//Axios
window.axios = require('axios');
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
window.axios.defaults.headers.common['Content-Type'] = 'application/json';
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';




Vue.use(ElementUI);
Vue.config.productionTip = false;
new Vue({
    router,
    store,
}).$mount('#app');
