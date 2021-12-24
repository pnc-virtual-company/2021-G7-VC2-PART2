import Vue from 'vue'
import VueRouter from 'vue-router'

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
    path: '/disciples',
    name: 'Disciples',
    component: () => import('@/components/views/Disciples.vue')
  },
  {
    path: '/studentlist',
    name: 'StudentList',
    component: () => import('@/components/views/StudentList.vue')
  },
  // {
  //   path: '/logout',
  //   name: 'Log Out',
  //   component: () => import('@/components/views/LogOut.vue')
  // },
  //   path: '/login',
  //   name: 'Login',
  //   component: () => import('@/components/form/FormLogin.vue')
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
