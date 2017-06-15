
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

Vue.component('ops-scheduler', require('./components/OpsCalendarScheduler.vue'));

Vue.component('clients-table', require('./components/clients/clients-table.vue'));

Vue.component('jo-table', require('./components/job-orders/jo-table.vue'));

Vue.component('create-job-order', require('./components/job-orders/create-job-order.vue'));

Vue.component('ongoing-table', require('./components/creatives/ongoing/ongoing-table.vue'));

Vue.component('admin-users-table', require('./components/admin/users/users-table.vue'));

Vue.component('admin-agencies-table', require('./components/admin/agencies/agencies-table.vue'));

Vue.component('admin-manpower-types-table', require('./components/admin/manpowerType/manpower-type-table.vue'));

Vue.component('admin-vehicle-types-table', require('./components/admin/vehicleType/vehicle-type-table.vue'));

Vue.component('admin-jo-table', require('./components/admin/jobOrders/admin-jo-table.vue'));

Vue.component('work-in-progress-table', require('./components/creatives/work-in-progress/work-in-progress-table.vue'));

Vue.component('venues-table', require('./components/venues/venues-table.vue'));

Vue.component('venues-selection-table', require('./components/venues/venue-selection-table.vue'));

Vue.component('add-ae-job-order', require('./components/job-orders/add-ae.vue'));

Vue.component('manpower-request-table', require('./components/job-orders/requests/manpower/manpower-table.vue'));

Vue.component('manpower-request-form', require('./components/job-orders/requests/manpower/commons/form.vue'));

Vue.component('meal-request-table', require('./components/job-orders/requests/meal/meal-table.vue'));

Vue.component('meal-request-form', require('./components/job-orders/requests/meal/commons/form.vue'));

Vue.component('vehicle-request-table', require('./components/job-orders/requests/vehicle/vehicle-table.vue'));

Vue.component('vehicle-request-form', require('./components/job-orders/requests/vehicle/commons/form.vue'));

Vue.component('department-involvement-table', require('./components/job-orders/involvement/involvement-table.vue'));

Vue.component('department-involvement-form', require('./components/job-orders/involvement/commons/form.vue'));

Vue.component('jo-inventory-table', require('./components/job-orders/inventory/inventory-table.vue'));

Vue.component('jo-inventory-form', require('./components/job-orders/inventory/commons/form.vue'));

Vue.component('project-status-table', require('./components/job-orders/project-status/project-status-table.vue'));

Vue.component('animation-details-table', require('./components/job-orders/animation-details/animation-details-table.vue'));

Vue.component('project-attachments-table', require('./components/job-orders/project-attachments/project-attachments-table.vue'));

Vue.component('plan-jo-table', require('./components/plans/plans-jo-table.vue'));

Vue.component('plan-animation-table', require('./components/plans/animation-details-table.vue'));

Vue.component('hr-vehicle-request', require('./components/HR/vehicle_request'));

Vue.component('discussions', require('./components/job-orders/discussion/discussions.vue'));

Vue.component('operations-jo-table', require('./components/operations/job-order/job-order-table.vue'));

Vue.component('operations-departments-jo-table', require('./components/operations/departments/jo-table.vue'));

Vue.component('ob-table', require('./components/operations/ob/ob-table.vue'));

require('./components/inventory');


import VeeValidate from 'vee-validate'

Vue.use(VeeValidate, {
    fieldsBagName: 'validate'
});

/* HR */
Vue.component('hraccount', require('./components/HR/hr-account.vue'));
Vue.component('manpower', require('./components/HR/manpower.vue'));
Vue.component('manpower-pooling', require('./components/HR/pooling.vue'));
Vue.component('pooling-content', require('./components/HR/poolingContent.vue'));

Vue.component('production-jo-table', require('./components/production/production-jo-table.vue'));

const app = new Vue({
    el: '#app'
});
