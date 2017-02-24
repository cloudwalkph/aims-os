
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.http.headers.common['Authorization'] = `Bearer ${window.token}`;

Vue.component('example', require('./components/Example.vue'));

Vue.component('scheduler', require('./components/CalendarScheduler.vue'));

Vue.component('admin-scheduler', require('./components/AdminCalendarScheduler.vue'));

Vue.component('clients-table', require('./components/clients/clients-table.vue'));

Vue.component('jo-table', require('./components/job-orders/jo-table.vue'));

Vue.component('create-job-order', require('./components/job-orders/create-job-order.vue'));

Vue.component('ongoing-table', require('./components/creatives/ongoing/ongoing-table.vue'));

Vue.component('admin-users-table', require('./components/admin/users/users-table.vue'));

Vue.component('admin-agencies-table', require('./components/admin/agencies/agencies-table.vue'));

Vue.component('admin-manpower-types-table', require('./components/admin/manpowerType/manpower-type-table.vue'));

Vue.component('work-in-progress-table', require('./components/creatives/work-in-progress/work-in-progress-table.vue'));

const app = new Vue({
    el: '#app'
});
