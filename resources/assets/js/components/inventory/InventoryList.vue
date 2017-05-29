<template>

    <div class="row">
        <div class="col-md-12">
            <h1 class="pull-left table-title">Inventory List</h1>
            <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modalCreateInventory">
                <i class="fa fa-plus" /> Create Inventory
            </button>
        </div>
        <div class="col-md-12 content">
          <div class="row">
            <div class="col-md-3 form-group">
                <v-select
                  :multiple="true"
                  :on-change="selectCategory"
                  :options="categoryOptions"
                  placeholder="Category"
                ></v-select>
            </div>
          </div>

          <InventoryVuetable
            ref="v"
            :api-url="apiUrl"
            detail-row-component="internal-inventory-detail-row"
            :fields="fields"
            :moreParams="moreParams"
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
              categoryOptions: [
                {
                  label: 'TShirt',
                  value: 'tshirt',
                },
                {
                  label: 'Pants',
                  value: 'pants',
                },
                {
                  label: 'Sandals',
                  value: 'sandals',
                },
              ],
              fields: [
                {
                  name: 'job_order.job_order_no',
                  title: 'Job Order Number',
                },
                {
                  name: 'job_order.project_name',
                  title: 'Project Name',
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
              moreParams: {},
            }
        },
        methods: {
          selectCategory (e) {
            var arr = [];
            for(var obj of e) {
              arr.push(obj.value);
            }
            this.moreParams = {
              category: arr,
            }
            Vue.nextTick( () => this.$refs.v.$refs.vuetableInventory.refresh() );
          },
          onRowClicked (dataItem, event) {
            Vue.nextTick( () => this.$refs.v.$refs.vuetableInventory.toggleDetailRow(dataItem.id) );
          },
          refreshVuetable: function () {
            Vue.nextTick( () => this.$refs.v.$refs.vuetableInventory.refresh() );
          },
        },
        props: {
          propData: Object
        }
    }

</script>
