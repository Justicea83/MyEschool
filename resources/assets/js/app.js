
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueSelect from 'vue-select';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('register-component', require('./components/register.vue'));
Vue.component('login-component', require('./components/Login.vue'));
Vue.component('reset-component', require('./components/reset.vue'));
Vue.component('password-component', require('./components/passwordReset.vue'));
Vue.component('teacher-component', require('./admincomponents/addTeacher.vue'));
Vue.component('add-class-component', require('./admincomponents/addClass.vue'));
Vue.component('breakdown-component', require('./admincomponents/breakdown.vue'));
Vue.component('academic-component', require('./admincomponents/academicYear.vue'));
Vue.component('term-component', require('./admincomponents/term.vue'));
Vue.component('fees-component', require('./admincomponents/fees.vue'));
Vue.component('course-component', require('./admincomponents/course.vue'));
Vue.component('class-courses-component', require('./admincomponents/class_course.vue'));
Vue.component('sms-parent',require('./admincomponents/sms_parent.vue'));
Vue.component('add-fees',require('./accountant/addFee.vue'));
const app = new Vue({
    el: '#app'
});
