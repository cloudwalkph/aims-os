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

                        <tr v-for="job in jobs">
                            <td>
                                {{job.job_order_no}}
                            </td>
                            <td>
                                {{job.project_name}}
                            </td>
                            <td>{{job.description}}</td>
                            <td>{{convertDate(job.deadline)}}</td>
                            <td>
                                {{assignedPersons(job)}}
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
        data: function () {
            return {
                jobs: this.propData.inventoryJobs
            }
        },
        methods: {
            assignedPersons: function(job) {
                var users = [];
                // for(job_user of job.user_id) {
                    for(user of this.propData.users) {
                        if(user.id == job.user_id) {
                            users.push(user.profile.first_name);
                        }
                    }
                // }
                return users.join(', ');
            },
            convertDate: function (dateVal) {
                var milliseconds = Date.parse(dateVal);
                var d = new Date(milliseconds);
                return d.toDateString();
            }
        },
        mounted: function () {
        },
        props: ['propData']
    }

</script>