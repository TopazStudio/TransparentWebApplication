import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

const UserForm = () => import(/* webpackChunkName: "registration" */'@/components/Registration/UserForm');
const LandingPage = () => import(/* webpackChunkName: "landing-page" */'@/Pages/LandingPage.vue');
const CompanyPage = () => import(/* webpackChunkName: "companypage" */'@/Pages/CompanyPage');
const ReviewPage = () => import(/* webpackChunkName: "reviewpage" */'@/Pages/ReviewPage');
const DocumentsPage = () => import(/* webpackChunkName: "documentsPage" */'@/Pages/DocumentsPage');

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
      },
      {
          path: '/company/:companyId',
          name: 'company-page',
          component: CompanyPage,
      },
      {
          path: '/company/:companyId/review',
          name: 'review-page',
          component: ReviewPage,
      },
      {
          path: '/company/:companyId/documents',
          name: 'documents-page',
          component: DocumentsPage,
      },
  ],
    mode: 'history'
})
