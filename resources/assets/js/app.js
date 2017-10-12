import Vue from 'vue';
import router from './Router';
import store from './Store';
import ElementUI from 'element-ui';

//Jquery
window.$ = window.jQuery = require('jquery');

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


//MIXINS
Vue.mixin({
    methods:{
        executeFunctionByName(functionName, context /*, args */) {
            console.log(functionName);
            let args = [].slice.call(arguments).splice(2);
            let namespaces = functionName.split(".");
            let func = namespaces.pop();
            for(let i = 0; i < namespaces.length; i++) {
                context = context[namespaces[i]];
            }
            return context[func].apply(context, args);
        }
    }
});
Vue.use(ElementUI);
Vue.config.productionTip = false;
new Vue({
    router,
    store,
    template: `<router-view></router-view>`
}).$mount('#app');
