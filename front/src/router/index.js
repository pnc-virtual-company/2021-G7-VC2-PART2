import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [
  {
    path: '/login',
    name: 'Login',
    component: () => import('@/components/form/FormLogin.vue')
  },
  // {
  //   path: '/user',
  //   name: 'User',
  //   component: () => import('@/components/views/User.vue')
  // },
  {
    path: '/navbar',
    name: 'Navbar',
    component: () => import('@/components/nav/Navbar.vue')
  },

]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
