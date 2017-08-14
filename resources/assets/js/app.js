
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Event from './services/EventBus';
import Form from './services/Form';
window.Form = Form;


//register external packeges
import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueSweetalert2);

//register Router
import VueRouter from 'vue-router';
import { Routes } from './routes/all';

Vue.use(VueRouter)

export var router = new VueRouter({
    routes: Routes,
    mode: 'history',
    linkActiveClass: 'is-active'
});


/**
 * Register custom components
 */
import bulmaInput from './components/global/bulma-input.vue';
Vue.component('bu-input', bulmaInput);

import loader from './components/global/loader.vue';
Vue.component('loader', loader);

/**
 * Register custom directives
 */
Vue.directive('focus', {
    inserted: function (el) {
        el.querySelector('input').focus()
    }
})


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


const app = new Vue({
    router,
    el: '#app'
});
