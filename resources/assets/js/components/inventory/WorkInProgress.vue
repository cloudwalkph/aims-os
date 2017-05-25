<template>

    <div class="row">
        <div class="col-md-12">
            <h1 class="pull-left table-title">Work In Progress</h1>
        </div>
        <div class="col-md-12">
          <InventoryVuetable
            :api-url="apiUrl"
            :fields="fields"
            :onRowClicked="onRowClicked"
          ></InventoryVuetable>
        </div>
    </div>

</template>

<script>
    var InventoryVuetable = require('./commons/InventoryVuetable');

    module.exports = {
      components: {
        InventoryVuetable,
      },
        data: function () {
            return {
              apiUrl: 'api/v1/inventory/job',
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
          onRowClicked (dataItem, event) {
            this.openPage('work-details', dataItem.id);
          },
        },
        mounted: function () {},
        props: {
          propIJobId: Number,
          openPage: Function,
          propData: Object
        }
    }
</script>
