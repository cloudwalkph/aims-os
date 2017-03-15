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

                        <tr v-for="job in jobs">
                            <td>
                                <a href="#" pageID="work-details" :iJobId="job.id" @click.prevent="openPage">
                                    {{job.job_order_no}}
                                </a>
                            </td>
                            <td>
                                <span>
                                    {{job.project_name}}
                                </span>
                            </td>
                            <td>
                                <span>
                                    {{assignedPersons(job)}}
                                </span>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</template>

<script>
    module.exports = {
        computed: {
            
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
            }
        },
        mounted: function () {

        },
        props: ['openPage','propData']
    }
</script>