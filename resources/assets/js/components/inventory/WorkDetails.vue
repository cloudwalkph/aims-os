<template>

    <div class="row">
        <div class="col-sm-12">
            <div class="row" v-for="workDetail in workDetails" v-if="workDetail.inventory_job_id == propIJobId">
                <div class="col-sm-12">
                    <div class="row" v-for="job in jobs" v-if="workDetail.inventory_job_id == job.id">
                        <div class="col-md-8">
                            <label htmlFor="joNumber" class="control-label">
                                Job Order Number : {{job.job_order_no}}
                            </label>
                        </div>
                        <div class="col-md-4 text-right">
                            <label htmlFor="assigned" class="control-label">
                                Assigned Persons : {{assignedPersons(job)}}
                            </label>
                        </div>
                        <div class="col-md-8">
                            <label htmlFor="projectName" class="control-label">
                                Project Name : {{job.project_name}}
                            </label>
                        </div>
                        <div class="col-md-4 text-right">
                            <label htmlFor="description" class="control-label">
                                Description : {{job.description}}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <delivery-tracking :workDetail="workDetail" :products="products"></delivery-tracking>
                </div>

                <div class="col-sm-12">
                    <hr/>
                </div>

                <div class="col-sm-12">
                    <release-tracking :workDetail="workDetail" :products="products"></release-tracking>
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
        data: function () {
            return {
                jobs: this.propData.inventoryJobs,
                products: this.propData.products,
                workDetails: this.propData.workDetails
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
        props: ['propData', 'propIJobId']
    }

</script>