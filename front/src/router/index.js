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
    path: '/studentlist',
    name: 'Student',
    component: () => import('@/components/views/StudentList.vue'),
    meta:'forAdmin',
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
 
];
// let authenticationGuard = (to,from,next)=>{
//   let needLogin = to.meta.needLogin;
//   if(needLogin){
//     let isLoggedIn=localStorage.getItem("userRole") !==null;
//     if(!isLoggedIn){
//       next("/user");
//     }else{
//       let needAdmin = to.meta.needAdmin;
//       if(needAdmin){
//         let isAdmin= localStorage.getItem("userRole") == "student";
//         if(isAdmin){
//           next();
//         }else{
//           next("/")
//         }
//       }else{
//         next();
//       }
//     }
//   }else{
//     next();
//   }
// }

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

// router.beforeEach(authenticationGuard);
export default router
