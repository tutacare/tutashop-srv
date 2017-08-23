
import router from './routes.js';
require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'

Vue.use(VueRouter)

// var Auth = {
//   loggedIn: false,
//   login: function() { this.loggedIn = true },
//   logout: function() { this.loggedIn = false }  
// };

// router.beforeEach((to, from, next) => {
//   if (to.matched.some(record => record.meta.requiresAuth) && !Auth.loggedIn) {
//     next({ path: '/login', query: { redirect: to.fullPath }});
//   } else {
//     next();
//   }
// });

const app = new Vue({
    el: '#app',
    router
});
