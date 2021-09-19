/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.moment = require('moment'); // require


window.Vue = require('vue').default;
import Vue from "vue"
import Toasted from 'vue-toasted'
Vue.use(Toasted);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('quiz-component', require('./components/QuizComponent.vue').default);
Vue.component('lanjut-component', require('./components/LanjutComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
