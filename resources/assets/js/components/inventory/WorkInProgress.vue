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

                        <tr v-for="joborder in propData.jobOrders">
                            <td>
                                <a href="#" pageID="work-details" :joID="joborder.jobOrderNo" @click.prevent="openPage">
                                    {{joborder.jobOrderNo}}
                                </a>
                            </td>
                            <td>
                                <div v-for="project in propData.projects" v-if="joborder.projectID == project.projectID">
                                    {{project.projectName}}
                                </div>
                            </td>
                            <td>
                                <div v-for="user in propData.users" v-if="joborder.assignedPerson == user.userID">
                                    {{user.label}}
                                </div>
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