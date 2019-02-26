/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

import "./bootstrap"

import Vue from "vue"
import router from "./router"
import BootstrapVue from 'bootstrap-vue'
import App from './App.vue'
import store from './store'
// import 'bootstrap/dist/css/bootstrap.css'
 import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue);

new Vue({
    router,
    store,
    render: (h) => h(App)
}).$mount('#app');
