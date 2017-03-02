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

                        <tr v-for="job in propData.jobs">
                            <td>
                                <span v-for="jobOrder in propData.jobOrders" v-if="job.job_order_id == jobOrder.id">
                                    <a href="#" pageID="work-details" :joID="job.id" @click.prevent="openPage">
                                        {{jobOrder.job_order_no}}
                                    </a>
                                </span>
                            </td>
                            <td>
                                <span v-for="jobOrder in propData.jobOrders" v-if="job.job_order_id == jobOrder.id">
                                    {{jobOrder.project_name}}
                                </span>
                            </td>
                            <td>
                                <span 
                                    v-for="assigned_person in propData.assignedPeople" 
                                    v-if="job.id == assigned_person.inventory_job_id"
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
    </div>
    
</template>

<script>
    module.exports = {
        props: ['openPage','propData']
    }
</script>