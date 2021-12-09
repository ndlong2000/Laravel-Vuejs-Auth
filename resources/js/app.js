/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import App from './App.vue';
import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from "./routes";

Vue.use(VueRouter);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('my-component', require('./components/MyComponent.vue').default);
Vue.component('conditional-rendering', require('./components/ConditionalRendering.vue').default);
Vue.component('list-rendering', require('./components/ListRendering').default);
Vue.component('user-dashboard', require('./components/UserDashboard.vue').default);
Vue.component('life-cycle', require('./components/LifeCycle.vue').default);
Vue.component('binding-html', require('./components/BindingHTML.vue').default);
Vue.component('event-handling', require('./components/EventHandling.vue').default);
Vue.component('parent', require('./components/Parent.vue').default);
Vue.component('api-calling', require('./components/ApiCalling.vue').default);

Vue.component('app', require('./App.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const router = new VueRouter({
    routes,
    mode: 'history'
});

function loggedIn(){
    return localStorage.getItem('token')
}

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (!loggedIn()) {
            next({
                path: '/login',
                query: { redirect: to.fullPath }
            })
        } else {
            next()
        }
    } else if(to.matched.some(record => record.meta.guest)) {
        if (loggedIn()) {
            next({
                path: '/',
                query: { redirect: to.fullPath }
            })
        } else {
            next()
        }
    } else {
        next() // make sure to always call next()!
    }
})


const app = new Vue({
    el: '#app',
    render: h => h(App),
    router
});
