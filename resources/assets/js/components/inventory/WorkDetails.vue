<template>

    <div class="row">
        <div class="col-sm-12">
            <div class="row" v-for="workDetail in propData.workDetails" v-if="workDetail.inventory_job_id == propJobOrderID">
                <div class="col-sm-12">
                    <div class="row" v-for="job in propData.jobs" v-if="workDetail.inventory_job_id = job.id">
                        <div class="col-md-8">
                            <label htmlFor="joNumber" class="control-label">
                                <span v-for="jobOrder in propData.jobOrders" v-if="job.job_order_id == jobOrder.id">
                                    Job Order Number : {{jobOrder.job_order_no}}
                                </span>
                            </label>
                        </div>
                        <div class="col-md-4 text-right">
                            <label htmlFor="assigned" class="control-label">
                                <span v-for="assigned_person in propData.assignedPeople" v-if="job.id == assigned_person.inventory_job_id">
                                    <span v-for="user in propData.users" v-if="assigned_person.user_id == user.id">
                                        Assigned Persons : {{user.profile.first_name}}
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="col-md-8">
                            <label htmlFor="projectName" class="control-label">
                                <span v-for="jobOrder in propData.jobOrders" v-if="job.job_order_id = jobOrder.id">
                                    Project Name : {{jobOrder.project_name}}
                                </span>
                            </label>
                        </div>
                        <div class="col-md-4 text-right">
                            <label htmlFor="description" class="control-label">
                                </span>
                                    Description : {{job.description}}
                                </span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <delivery-tracking :deliveries="workDetail.deliveries" :products="propData.products"></delivery-tracking>
                </div>

                <div class="col-sm-12">
                    <hr/>
                </div>

                <div class="col-sm-12">
                    <release-tracking :releases="workDetail.releases" :products="propData.products"></release-tracking>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    var DeliveryTracking = require('./DeliveryTracking.vue');
    var ReleaseTracking = require('./ReleaseTracking.vue');

    module.exports = {
        components: {
            DeliveryTracking,
            ReleaseTracking
        },
        props: ['propData', 'propJobOrderID']
    }

</script>