import Vue from 'vue';
import router from './Router';
import store from './Store';
import ElementUI from 'element-ui';
import {apolloProvider} from './Apollo';
require('./Mixins'); //Vue Mixins
require('./Util');
require('./components/global');


Vue.use(ElementUI);
Vue.config.productionTip = false;
new Vue({
    apolloProvider,
    router,
    store,
    template: `<router-view></router-view>`
}).$mount('#app');
