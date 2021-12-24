import Vue from 'vue'
import VueRouter from 'vue-router'
import FormLogin from '../components/form/FormLogin.vue';


Vue.use(VueRouter)

const routes = [

  {
    path: '/user',
    name: 'User',
    component: () => import('@/components/views/User.vue')
  },
  {
    path: '/permission',
    name: 'Permission',
    component: () => import('@/components/views/Permission.vue')
  },
  {
    path: '/disciplines',
    name: 'Disciplines',
    component: () => import('@/components/views/Disciplines.vue')
  },
  {
    path: '/studentlist',
    name: 'StudentList',
    component: () => import('@/components/views/StudentList.vue')
  },
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

]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
