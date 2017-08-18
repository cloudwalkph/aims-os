<template>

    <div class="row">
        <div class="col-md-12">
            <h1 class="pull-left table-title">Ongoing Project</h1>
            <button 
              v-if="currentUser.user_role_id < 3" 
              type="button" 
              class="btn btn-primary pull-right" 
              data-toggle="modal" 
              data-target="#modalCreateJob"
            >
              <i class="fa fa-plus"></i> Create Job
            </button>
        </div>
        <div class="col-md-12">
            <InventoryVuetable
              ref="onGoingProjectsVuetable"
              api-url="api/v1/inventory/job"
              :fields="fields"
            ></InventoryVuetable>
        </div>
        <component is="createJobModal" :propData="propData" :refresh-vuetable="refreshVuetable">
        </component>
    </div>

</template>

<script>
    module.exports = {
        components: {
          CreateJobModal: require('./modals/CreateJob'),
          InventoryVuetable: require('./commons/InventoryVuetable')
        },
        data: function () {
            return {
              refVuetable: this.$refs.onGoingProjectsVuetable,
              fields: [
                {
                  name: 'job_order.job_order_no',
                  title: 'Job Order Number',
                  sortField: 'job_order_no',
                },
                {
                  name: 'job_order.project_name',
                  title: 'Project Name',
                  sortField: 'project_name',
                },
                {
                  name: 'description',
                  title: 'Description',
                },
                {
                  name: 'deadline',
                  title: 'Deadline',
                  sortField: 'deadline',
                  callback: 'convertDate',
                },
                {
                  name: 'assigned_person',
                  title: 'Assigned Persons',
                  sortField: 'first_name',
                  callback: 'getAssignedPerson',
                },
              ],
              jobs: this.propData.inventoryJobs
            }
        },
        methods: {
          refreshVuetable: function () {
            this.$refs.onGoingProjectsVuetable.$refs.vuetableInventory.refresh();
          }
        },
        props: {
          currentUser: {
            type: Object
          },
          propData: {
            type: Object
          }
        }
    }

</script>
