import 'es6-promise/auto'
import axios from 'axios'
import Vue from 'vue'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'
import router from './router'
import store from './store'
import Index from './Index.vue'
import { BootstrapVue } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'


Vue.use(BootstrapVue)

const app = new Vue({
    components: { Index },
    router,
    store
}).$mount('#app')