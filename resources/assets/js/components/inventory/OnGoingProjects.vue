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

                        <tr v-for="jobOrder in propData.jobOrders">
                            <td>{{jobOrder.jobOrderNo}}</td>
                            <td
                                v-for="project in propData.projects" 
                                v-if="jobOrder.projectID == project.projectID"
                            >{{project.projectName}}
                            </td>
                            <td>{{jobOrder.description}}</td>
                            <td>{{jobOrder.deadline}}</td>
                            <td
                                v-for="user in propData.users" 
                                v-if="user.userID == jobOrder.assignedPerson"
                            >{{user.label}}
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <CreateJobModal :propData="propData"></CreateJobModal>
    </div>

    

</template>

<script>
    var CreateJobModal = require('./modals/CreateJob.vue');

    module.exports = {
        components: {
            CreateJobModal
        },
        props: ['propData']
    }
</script>