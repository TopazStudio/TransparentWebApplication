import Vue from 'vue';
import router from './Router';
import store from './Store';
import ElementUI from 'element-ui';
import {apolloProvider} from './Apollo';
import App from './Pages/Layout.vue';
require('./Mixins'); //Vue Mixins
require('./Util');
require('./components/global');


Vue.use(ElementUI);
Vue.config.productionTip = false;

new Vue({
    components:{App},
    apolloProvider,
    router,
    store,
    template: `<app></app>`
}).$mount('#app');
