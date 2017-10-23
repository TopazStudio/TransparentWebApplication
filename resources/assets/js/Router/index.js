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
          component: require('@/Pages/LandingPage.vue')
      },
      {
          path: '/register',
          component: require('@/Pages/Registration.vue'),
          children: [
              {
                  path:'',
                  component: require('@/components/Registration/UserForm'),
              },
              {
                  path: '/register/user',
                  name: 'user-registration',
                  component: require('@/components/Registration/UserForm')
              },
              {
                  path: '/register/company',
                  name: 'company-registration',
                  component: require('@/components/Registration/CompanyForm')
              }
          ]
      }
  ],
    mode: 'history'
})
