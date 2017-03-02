<template>

    <div class="row">
        <div class="col-md-12">
            <h1 class="pull-left table-title">Ongoing Project</h1>
            <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modalCreateJob">
                <i class="fa fa-plus"></i> Create Job 
            </button>
            <div class="content">
                <table class="table table-striped" id="projectList">
                    <thead>
                        <tr>
                            <th>Job Order Number</th>
                            <th>Project Name</th>
                            <th>Description</th>
                            <th>Deadline</th>
                            <th>Assigned Persons</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr v-for="job in propData.jobs">
                            <td>
                                <span v-for="jobOrder in propData.jobOrders" v-if="job.job_order_id == jobOrder.id">
                                    {{jobOrder.job_order_no}}
                                </span>
                            </td>
                            <td>
                                <span v-for="jobOrder in propData.jobOrders" v-if="job.job_order_id == jobOrder.id">
                                    {{jobOrder.project_name}}
                                </span>
                            </td>
                            <td>{{job.description}}</td>
                            <td>{{convertDate(job.deadline)}}</td>
                            <td>
                                <span 
                                    v-for="assigned_person in propData.assignedPeople" 
                                    v-if="assigned_person.inventory_job_id == job.id"
                                >
                                    <span v-for="user in propData.users" v-if="assigned_person.user_id == user.id">
                                        {{user.profile.first_name}}
                                    </span>
                                </span>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <component is="create-job-modal" :propData="propData">
        </component>
    </div>



</template>

<script>
    var CreateJobModal = require('./modals/CreateJob.vue');

    module.exports = {
        components: {
            CreateJobModal
        },
        methods: {
            convertDate: function (dateVal) {
                var milliseconds = Date.parse(dateVal);
                var d = new Date(milliseconds);
                return d.toDateString();
            }
        },
        props: ['propData']
    }

</script>