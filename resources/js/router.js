import Vue from "vue";
import VueRouter  from "vue-router";
// Pages
import Homepage from './pages/Homepage'
import Register from './pages/Register'
import Login from './pages/Login'

Vue.use(VueRouter);
// Routes
const routes = [
    {
      path: '/',
      name: 'Homepage',
      component: Homepage,
    },

    {
      path: '/register',
      name: 'Register',
      component: Register,
    },

        {
      path: '/login',
      name: 'Login',
      component: Login,
      meta: {
        auth: false
      }
    },

  ]


const router = new VueRouter({
    routes
})


export default router
