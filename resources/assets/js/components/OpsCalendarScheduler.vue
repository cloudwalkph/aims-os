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
                editable: true
                // events: events
            });

            this.getJos();
        },
        data() {
            return {
                title: '',
                event_datetime: moment().format("YYYY-MM-DD HH:mm"),
                description: '',
                currentEvents: []
            }
        },
        methods: {
            getJos() {
                let url = `/api/v1/job-orders/calendar/`;
                this.$http.get(url).then(response => {
                    let events = [];
                    let $calendar = $('.calendar');

                    this.currentEvents = response.data;

                    // Remove events
                    $calendar.fullCalendar('removeEvents');

                    for (let event of this.currentEvents) {

                        events.push({
                            id: event.id,
                            title: event.title,
                            start: event.date,
                            backgroundColor: event.color,
                            borderColor: event.color,
                            // constraint: 'businessHours'
                        });
                    }

                    $calendar.fullCalendar('renderEvents', events, true);
                }, error => {
                    console.log(error)
                })
            }
        }
    }
</script>
