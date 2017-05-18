<template>

    <div class="row">
        <div class="col-sm-12">
            <div
              class="row"
              v-for="job in iJobs"
              :key="job.id"
            >
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-md-8">
                            <label htmlFor="joNumber" class="control-label">
                                Job Order Number : {{job.job_order.job_order_no}}
                            </label>
                        </div>
                        <div class="col-md-4 text-right">
                            <label htmlFor="assigned" class="control-label">
                                Assigned Persons : {{getAssignedPerson(job.assigned_person)}}
                            </label>
                        </div>
                        <div class="col-md-8">
                            <label htmlFor="projectName" class="control-label">
                                Project Name : {{job.job_order.project_name}}
                            </label>
                        </div>
                        <div class="col-md-4 text-right">
                            <label htmlFor="remarks" class="control-label">
                                Description : {{job.description}}
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <delivery-tracking
                              :propIJobId="propIJobId"
                              :products="job.job_order.product_deliveries"
                            >
                            </delivery-tracking>
                        </div>

                        <div class="col-sm-12">
                            <hr>
                        </div>

                        <div class="col-sm-12">
                            <release-tracking
                              :propIJobId="propIJobId"
                              :products="job.job_order.product_deliveries"
                            >
                            </release-tracking>
                        </div>
                    </div>
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
                iJobs: [],
            }
        },
        methods: {
          getJob: function () {
              this.$http.get('/api/v1/inventory/job/' + this.propIJobId)
                  .then(function (response) {
                      this.iJobs.push(response.data);
                  })
                  .catch(function (e) {
                      console.log('error inventory jobs', e);
                  });
          },
          getAssignedPerson (val) {
            var person = [];
            val.map(function(value, index) {
              person.push(value.user.profile.first_name + ' ' + value.user.profile.last_name);
            });
            return person.join(', ');
          },
        },
        mounted: function () {
          this.getJob();
        },
        props: ['propData', 'propIJobId']
    }

</script>
