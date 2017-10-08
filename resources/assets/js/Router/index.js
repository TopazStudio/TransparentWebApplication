import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

export default new Router({
  routes: [
    {
        path: '*',
        redirect: '/'
    },
    {
        path: '/',
        name: 'landing-page',
        component: require('../components/Example.vue')
    }
  ]
})
