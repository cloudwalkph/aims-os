<template>
    <div class="row">
        <div class="col-md-5">
            <div v-for="event in currentEvents">
                <div class="col-md-12 col-sm-12 col-xs-12 event">
                    <h1 class="event-title">{{ event.title }}</h1>
                    <p class="event-date">{{ event.event_datetime }}</p>
                    <p class="event-desc">Description: {{ JSON.parse(event.meta).description }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <button class="btn btn-primary pull-right"
                    data-toggle="modal" data-target="#createSchedule" style="margin-bottom: 20px">
                <i class="fa fa-plus"></i> New Schedule
            </button>
            <div class="clearfix"></div>
            <div class="calendar"></div>
        </div>

        <div class="modal fade" id="createSchedule" tabIndex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Client Form</h4>
                    </div>
                    <div class="modal-body">
                        <form id="scheduleForm">
                            <div class="row">
                                <div class="col-md-12 form-group text-input-container">
                                    <label class="control-label">Schedule Title</label>
                                    <input type="text" name="company"
                                           @input="inputChange" v-bind:value="title" id="title"
                                           placeholder="Enter schedule title" class="form-control" />
                                </div>
                                <div class="col-md-12 form-group text-input-container">
                                    <label class="control-label">Date</label>
                                    <input type="text" name="contact_person"
                                           @input="inputChange" v-bind:value="event_datetime" id="event_datetime"
                                           placeholder="Enter contact person" class="form-control" />
                                </div>
                                <div class="col-md-12 form-group text-input-container">
                                    <label class="control-label" for="description">Additional Information</label>
                                    <textarea class="form-control" name="meta[description]"
                                              @input="inputChange" v-bind:value="description" id="description"
                                              cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="saveSchedule">Save</button>
                    </div>
                </div>
            </div>
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

            $('#event_datetime').datetimepicker({
                defaultDate: this.event_datetime,
                sideBySide: true
            });
            $('#event_datetime').on('dp.change', (newDate, oldDate) => {
                this.event_datetime = newDate.date.format("YYYY-MM-DD hh:mm a");
            });

            this.getEvents();
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
            saveSchedule() {
                let data = {
                    title: this.title,
                    event_datetime: moment(this.event_datetime, "YYYY-MM-DD hh:mm a").format("YYYY-MM-DD HH:mm"),
                    meta: {
                        description: this.description
                    },
                }

                let url = `/api/v1/events`;
                this.$http.post(url, data).then(response => {
                    console.log(response)

                    $('#createSchedule').modal('hide')
                    this.getEvents()
                }, error => {
                    console.log(error)
                })
            },
            getEvents() {
                let url = `/api/v1/events`;
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
                            start: event.event_datetime,
                            // constraint: 'businessHours'
                        });
                    }

                    $calendar.fullCalendar('renderEvents', events);
                }, error => {
                    console.log(error)
                })
            },
            inputChange(e) {
                this[e.target.id] = e.target.value
            }
        }
    }
</script>
