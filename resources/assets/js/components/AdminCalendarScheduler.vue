<template>
    <div class="row">
        <div class="col-md-12">
            <div class="clearfix"></div>
            <div class="calendar"></div>
        </div>

    </div>
</template>

<script>
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
        },
    }
</script>
