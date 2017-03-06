
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

Vue.component('venues-table', require('./components/venues/venues-table.vue'));

Vue.component('add-ae-job-order', require('./components/job-orders/add-ae.vue'));

Vue.component('manpower-request-table', require('./components/job-orders/requests/manpower/manpower-table.vue'));

Vue.component('manpower-request-form', require('./components/job-orders/requests/manpower/commons/form.vue'));

Vue.component('meal-request-table', require('./components/job-orders/requests/meal/meal-table.vue'));

Vue.component('meal-request-form', require('./components/job-orders/requests/meal/commons/form.vue'));

Vue.component('vehicle-request-table', require('./components/job-orders/requests/vehicle/vehicle-table.vue'));

Vue.component('vehicle-request-form', require('./components/job-orders/requests/vehicle/commons/form.vue'));

Vue.component('department-involvement-table', require('./components/job-orders/involvement/involvement-table.vue'));

Vue.component('department-involvement-form', require('./components/job-orders/involvement/commons/form.vue'));

Vue.component('project-status-table', require('./components/job-orders/project-status/project-status-table.vue'));

Vue.component('animation-details-table', require('./components/job-orders/animation-details/animation-details-table.vue'));

require('./components/inventory');

/* HR */
Vue.component('hraccount', require('./components/HR/hr-account.vue'));
Vue.component('manpower', require('./components/HR/manpower.vue'));
Vue.component('manpower-pooling', require('./components/HR/pooling.vue'));
Vue.component('pooling-content', require('./components/HR/poolingContent.vue')); 

const app = new Vue({
    el: '#app'
});
