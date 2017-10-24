import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

const LandingPage = () => import(/* webpackChunkName: "landing-page" */'@/Pages/LandingPage.vue');
const UserForm = () => import(/* webpackChunkName: "registration" */'@/components/Registration/UserForm');

//Imports google maps
const CompanyForm = () => import(/* webpackChunkName: "registration" */'@/components/Registration/CompanyForm');

export default new Router({
  routes: [
      {
          path: '*',
          redirect: '/'
      },
      {
          path: '/',
          name: 'landing-page',
          component: LandingPage,
      },
      {
          path: '/register',
          component: require('@/Pages/Registration.vue'),
          children: [
              {
                  path:'',
                  component: UserForm,
              },
              {
                  path: '/register/user',
                  name: 'user-registration',
                  component: UserForm,
              },
              {
                  path: '/register/company',
                  name: 'company-registration',
                  component: CompanyForm,
              }
          ]
      }
  ],
    mode: 'history'
})
