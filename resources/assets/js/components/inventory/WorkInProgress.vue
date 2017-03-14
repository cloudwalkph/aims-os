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
                                    {{job.first_name}}
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
        data: function () {
            return {
                jobs: this.propData.jobs
            }
        },
        methods: {

        },
        mounted: function () {

        },
        props: ['openPage','propData']
    }
</script>