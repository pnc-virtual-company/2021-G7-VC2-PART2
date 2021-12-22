import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [
  {
    path:'/',
    component:() => import('@/components/views/StudentList.vue')
  },
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
  
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
