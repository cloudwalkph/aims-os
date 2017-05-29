<template>

    <div class="row">
        <div class="col-md-6">
            <h1 class="pull-left table-title">Inventory List</h1>
        </div>
        <div class="col-md-6">
          <div class="row pull-right">
            <div class="col-md-12">
              <button
                class="btn btn-primary"
                data-toggle="modal"
                data-target="#modalCreateInventory"
                type="button"
              ><i class="fa fa-plus"></i> Create Inventory
              </button>

              <button
                class="btn btn-default"
                data-target="#importInternalInventoryModal"
                data-toggle="modal"
                type="button"
              ><i class="fa fa-upload"></i> Import From Excel
              </button>
            </div>
          </div>
        </div>
        <div class="col-md-12 content">
          <div class="row">
            <div class="col-md-4 form-group">
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

        <div class="modal fade" id="importInternalInventoryModal" tabIndex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Import Internal Inventory</h4>
                    </div>
                    <form id="importInternalInventoryForm" @submit.prevent="importInternalInventory">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 form-group text-input-container">
                                    <label class="control-label">Excel File only</label>
                                    <input type="file" name="excel" id="excel"
                                        placeholder="Excel File" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button class="btn btn-primary" type="submit">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
          importInternalInventory (e) {
            var form = $(e.target)[0];
            var formData = new FormData(form);

            this.$http.post('api/v1/inventory/import', formData)
                .then(function (response) {
                    console.log(response);
                    // this.propData.internalInventory.push(formData);
                    // $('#importInternalInventoryModal').modal('hide');
                    // form.reset();
                    Vue.nextTick( () => this.$refs.v.$refs.vuetableInventory.refresh() );
                })
                .catch(function (e) {
                    console.log('error post jobs', e);
                });
          },
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
