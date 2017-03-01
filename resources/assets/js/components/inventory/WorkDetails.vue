<template>

    <div class="row">
        <div class="col-sm-12">
            <div class="row" v-for="jobOrder in propData.jobOrders" v-if="jobOrder.jobOrderNo == propJobOrderID">
                <div class="col-sm-12">
                    <div class="col-md-8">
                        <label htmlFor="joNumber" class="control-label">Job Order Number : {{jobOrder.jobOrderNo}}</label>
                    </div>
                    <div class="col-md-4 text-right">
                        <label htmlFor="assigned" class="control-label">
                            <span v-for="user in propData.users" v-if="jobOrder.assignedPerson == user.userID">
                                Assigned Persons : {{user.label}}
                            </span>
                        </label>
                    </div>
                    <div class="col-md-8">
                        <label htmlFor="projectName" class="control-label">
                            <span v-for="project in propData.projects" v-if="jobOrder.projectID == project.projectID">
                                Project Name : {{project.projectName}}
                            </span>
                        </label>
                    </div>
                    <div class="col-md-4 text-right">
                        <label htmlFor="description" class="control-label">
                            Description : {{jobOrder.description}}
                        </label>
                    </div>
                </div>

                <div class="col-sm-12">
                    <delivery-tracking :traces="jobOrder.traces" :products="propData.products"></delivery-tracking>
                </div>

                <div class="col-sm-12">
                    <hr/>
                </div>

                <div class="col-sm-12">
                    <release-tracking :traces="jobOrder.traces" :products="propData.products"></release-tracking>
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