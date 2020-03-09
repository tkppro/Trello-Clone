require('./bootstrap');

import Vue from 'vue'
import App from './App.vue'
import { store } from './store/store'
import router from './router/route'
import vuetify from './plugins/vuetify';
import 'vuetify/dist/vuetify.min.css'

Vue.config.productionTip = false

const app = new Vue({
    store,
    router,
    vuetify,
    render: h => h(App)
}).$mount('#app')