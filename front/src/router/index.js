import Vue from 'vue'
import VueRouter from 'vue-router'
import FormLogin from '../components/form/FormLogin.vue';
import Users from '../components/views/Users.vue';

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Login',
    component: FormLogin
  },
  {
    path: '/logout',
    name: 'logout',
    component: FormLogin
  },
  {
    path: '/login',
    name: 'login',
    component: FormLogin
  },
  {
    path: '/user',
    name: 'Users',
    component: Users
  },

]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
