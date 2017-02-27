<template>

    <div class="row">
        <div class="col-md-12">
            <h1 class="pull-left table-title">Work In Progress</h1>
            <div class="col-md-12">
                <table id="josList" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Job Order Number</th>
                            <th>Project Name</th>
                            <th>Assigned Persons</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr v-for="joborder in joborders">
                            <td>
                                <a href="" @click.prevent="handleClick">{{joborder.jobOrderNo}}</a>
                            </td>
                            <td>{{joborder.projectName}}</td>
                            <td>{{joborder.assignedPerson}}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</template>

<script>
    module.exports = {
        data: function() {
            return {
                joborders: [
                    {
                        jobOrderNo: 1,
                        projectName: 'Project Name',
                        assignedPerson: 'Alleo Indong'
                    },
                    {
                        jobOrderNo: 2,
                        projectName: 'Project Name 2',
                        assignedPerson: 'Michael Alumno'
                    },
                ]
            }
        },
        methods: {
            handleClick: function() {
                alert('open Work Details Page');
            }
        }
    }
</script>