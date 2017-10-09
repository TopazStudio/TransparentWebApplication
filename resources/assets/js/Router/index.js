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
          component: require('../components/LandingPage.vue')
      },
      {
          path: '/register/company',
          name: 'company-registeration',
          component: require('../components/Registration.vue')
      },
      {
          path: '/register/user',
          name: 'normal-registeration',
          component: require('../components/Registration.vue')
      }
  ]
})
