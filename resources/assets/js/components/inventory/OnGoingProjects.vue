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

                        <tr v-for="joborder in joborders">
                            <td>{{joborder.jobOrderNo}}</td>
                            <td>{{joborder.projectName}}</td>
                            <td>{{joborder.description}}</td>
                            <td>{{joborder.date}}</td>
                            <td>{{joborder.assignedPerson}}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <CreateJobModal></CreateJobModal>
    </div>

    

</template>

<script>
    var CreateJobModal = require('./modals/CreateJob.vue');

    module.exports = {
        data: function() {
            return {
                joborders: [
                    {
                        jobOrderNo: 1,
                        projectName: 'Project Name',
                        description: 'description',
                        date: '1/11/2017',
                        assignedPerson: 'Assigned Person'
                    }

                ]
            }
        },
        components: {
            CreateJobModal
        }
    }
</script>