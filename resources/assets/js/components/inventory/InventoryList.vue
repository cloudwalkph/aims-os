<template>

    <div class="row">
        <div class="col-md-12">
            <h1 class="pull-left table-title">Inventory List</h1>
            <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modalCreateInventory">
                <i class="fa fa-plus" /> Create Inventory
            </button>
        </div>
        <div class="col-md-12">
          <InventoryVuetable
            ref="vuetableInventory"
            :api-url="apiUrl"
            detail-row-component="internal-inventory-detail-row"
            :fields="fields"
            :on-row-clicked="onRowClicked"
          ></InventoryVuetable>
        </div>

        <CreateInventoryModal :propData="propData" :refresh-vuetable="refreshVuetable"></CreateInventoryModal>
    </div>

</template>

<script>
    var CreateInventoryModal = require('./modals/CreateInventory.vue');
    var InternalInventoryDetailRow = require('./commons/InternalInventoryDetailRow');
    Vue.component('internal-inventory-detail-row', InternalInventoryDetailRow);
    var InventoryVuetable = require('./commons/InventoryVuetable');

    module.exports = {
        components: {
          CreateInventoryModal,
          InventoryVuetable,
        },
        data: function () {
            return {
              apiUrl: 'api/v1/inventory',
              fields: [
                {
                  name: 'job_order_no',
                  title: 'Job Order Number',
                  sortField: 'job_order_no',
                },
                {
                  name: 'category',
                  title: 'Category',
                  sortField: 'category',
                },
                {
                  name: 'product_code',
                  title: 'SKU',
                  sortField: 'product_code',
                },
                {
                  name: 'name',
                  title: 'Inventory Name',
                  sortField: 'name',
                },
                {
                  name: 'quantity',
                  title: 'Quantity',
                  sortField: 'quantity',
                },
                {
                  name: 'expiration_date',
                  title: 'Expiration Date',
                  callback: 'convertDate',
                  sortField: 'expiration_date',
                },
                {
                  name: 'status',
                  title: 'Status',
                  sortField: 'status',
                },
              ],
            }
        },
        methods: {
          onRowClicked (dataItem, event) {
            this.$refs.vuetableInventory.$refs.vuetableInventory.toggleDetailRow(dataItem.id);
          },
          refreshVuetable: function () {
            this.$refs.vuetableInventory.$refs.vuetableInventory.refresh();
          },
        },
        props: {
          propData: Object
        }
    }

</script>
