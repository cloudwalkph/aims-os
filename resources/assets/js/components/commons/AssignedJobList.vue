<template>

    <div class="row">
        <div class="col-md-12">
            <h3>Assigned Job Orders</h3>
            <div class="row assigned-jo">
                <div class="col-md-12 jo-item" v-for="(jo, index) in jos" v-on:click="showModal(jo.job_order.job_order_no)">
                    <div class="project-name">{{jo.job_order.project_name}}</div>

                    <div class="project-body">
                        <strong>Job Order #:</strong> <span>{{jo.job_order.job_order_no}}</span> <br>
                        <strong>Deadline:</strong> <span>{{convertDate(jo.deadline)}}</span> <br>
                        <strong>AE:</strong> <span>{{jo.job_order.user.profile.first_name}} {{jo.job_order.user.profile.last_name}} </span>                        <br>
                        <strong>Status:</strong> <span>{{jo.job_order.status}}</span>
                    </div>
                </div>

                <AssignedJobDetails v-for="jo in jos" :id="jo.job_order.job_order_no" :jo="jo"></AssignedJobDetails>
            </div>
        </div>
    </div>
</template>

<script>
    var AssignedJobDetails = require('./modals/AssignedJobDetails.vue');

    module.exports = {
        components: {
            AssignedJobDetails
        },
        data: function () {
            return {
                job_order_no: '',
                jos: this.propData.assignedJobs
            }
        },
        methods: {
            convertDate: function (dateVal) {
                var milliseconds = Date.parse(dateVal);
                var d = new Date(milliseconds);
                return d.toDateString();
            },
            showModal: function (job_order_no) {
                $('#' + job_order_no).modal('show');
            },
        },
        mounted: function () {
        },
        props: [
            'propData'
        ]
    }

</script>