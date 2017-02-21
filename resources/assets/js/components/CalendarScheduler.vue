<template>
    <div class="row">
        <div class="col-md-5">

        </div>

        <div class="col-md-7">
            <div class="calendar"></div>
        </div>
    </div>
</template>

<script>
    require('fullcalendar')

    export default {
        mounted() {
            $('.calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,listMonth'
                },
                navLinks: true, // can click day/week names to navigate views
                // businessHours: true, // display business hours
                editable: true,
                // events: events
            });
        }
    }
</script>
