import Vue from 'vue'
import App from './App'
import { BootstrapVue } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import VueLodash from 'vue-lodash'
import lodash from 'lodash'
import axios from 'axios';
import VueAxios from 'vue-axios';
import VueRouter from 'vue-router'

Vue.config.productionTip = false

Vue.use(BootstrapVue)
Vue.use(VueLodash, { name: 'custom', lodash: lodash })
Vue.use(VueAxios, axios)

// Роутинг
import Main from './components/page/main/Main'
import Add from "./components/page/add/Add"
import Edit from "./components/page/edit/Edit"
import Error from "./components/page/error/Error"
const router = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/', component: Main, name: 'main' },
        { path: '/add', component: Add, name: 'add' },
        { path: '/:id/edit', component: Edit, name: 'edit' },
        { path: '*', component: Error, name: 'not-found' },
    ]
});
Vue.use(VueRouter)

new Vue({
    router,
    render: h => h(App)
}).$mount('#app');