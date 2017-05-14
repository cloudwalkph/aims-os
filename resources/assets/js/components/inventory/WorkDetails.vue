<template>

    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-12">
                    <div
                      class="row"
                      v-for="job in jobs"
                      :key="job.id"
                      v-if="job.id == propIJobId"
                    >
                        <div class="col-md-8">
                            <label htmlFor="joNumber" class="control-label">
                                Job Order Number : {{jobOrderNo(job)}}
                            </label>
                        </div>
                        <div class="col-md-4 text-right">
                            <label htmlFor="assigned" class="control-label">
                                Assigned Persons : {{assignedPersons(job)}}
                            </label>
                        </div>
                        <div class="col-md-8">
                            <label htmlFor="projectName" class="control-label">
                                Project Name : {{projectName(job)}}
                            </label>
                        </div>
                        <div class="col-md-4 text-right">
                            <label htmlFor="remarks" class="control-label">
                                Description : {{job.description}}
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <delivery-tracking
                        :workDetail="workDetail"
                        :products="products"
                        v-for="inventoryJob in propData.inventoryJobs"
                        :key="inventoryJob.id"
                        v-if="inventoryJob.id == propIJobId"
                        :inventoryJob="inventoryJob"
                    >
                    </delivery-tracking>
                </div>

                <div class="col-sm-12">
                    <hr>
                </div>

                <div class="col-sm-12">
                    <release-tracking
                        :workDetail="workDetail"
                        :products="products"
                        v-for="inventoryJob in propData.inventoryJobs"
                        :key="inventoryJob.id"
                        v-if="inventoryJob.id == propIJobId"
                        :inventoryJob="inventoryJob"
                    >
                    </release-tracking>
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
                workDetail: this.propData.workDetail
            }
        },
        methods: {
            assignedPersons: function (job) {
              var person = [];
              for (value of job.assigned_person) {
                person.push(value.user.profile.first_name + ' ' + value.user.profile.last_name);
              }
              return person.join(', ');
            },
            jobOrderNo: function (job) {
                for (jo of this.propData.jobOrders) {
                    if (jo.id == job.job_order_id) {
                        return jo.job_order_no;
                    }
                }
            },
            projectName: function (job) {
                for (jo of this.propData.jobOrders) {
                    if (jo.id == job.job_order_id) {
                        return jo.project_name;
                    }
                }
            }
        },
        mounted: function () {
        },
        props: ['propData', 'propIJobId']
    }

</script>
