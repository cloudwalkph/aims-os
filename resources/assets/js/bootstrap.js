
window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.$ = window.jQuery = require('jquery');

require('bootstrap-sass');

/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */

window.Vue = require('vue');
require('vue-resource');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');


/**
 * Moment js
 */
window.moment = require('moment');

/**
 * FullCalendar
 */
window.fullcalender = require('fullcalendar');

/**
 * Toastr
 */
window.toastr = require('toastr');

/**
 * datetimepicker
 */
window.datetimepicker = require('../lib/datetimepicker/js/bootstrap-datetimepicker.min');

/**
 * ionRangeSlider
 */
window.ionRangeSlider = require('../lib/ion.rangeSlider.min');

/**
 * Slick
 */
window.slick = require('slick-carousel');

/**
 * Toastr Config
 *
 */
toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

$(function () {
    $('#date_time').datetimepicker();
    $('#deadline').datetimepicker();
    $('#event_when').datetimepicker();
    $('#expected_delivery_date').datetimepicker();

    $(".location #lsm").ionRangeSlider({
        type: "double",
        grid: false,
        min: 0,
        max: 5,
        from: 1,
        to: 4,
        step: 1
    });
});

window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest',
    'Authorization': 'Bearer ' + window.token
};

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from "laravel-echo"
window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'dbbbc3a5c9b47ac1b3bd',
    cluster: 'ap1',
});

