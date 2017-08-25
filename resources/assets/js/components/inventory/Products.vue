<template>

    <div class="row">
        <div class="col-sm-12">
            <h1>Product List</h1>
            <button class="btn btn-default pull-right" onclick="frames['productListFrame'].print()">
                <i class="fa fa-print fa-lg"></i> Print Product List
            </button>
        </div>
        <div class="col-md-12">
          <InventoryVuetable
            :api-url="apiUrl"
            :fields="fields"
          ></InventoryVuetable>
        </div>

        <iframe name="productListFrame" :src="frameSrc" style="width:0; height:0"></iframe>
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
              apiUrl: 'api/v1/job-order-inventory/all',
              frameSrc: 'inventory/print/product',
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
                  name: 'item_name',
                  title: 'Item Name',
                  sortField: 'item_name',
                },
                {
                  name: 'expected_quantity',
                  title: 'Expected Quantity',
                },
                {
                  name: 'products_on_hand',
                  title: 'Products on Hand',
                },
                {
                  name: 'total_disposed',
                  title: 'Disposed'
                }
              ],
              sortOrder: [
                { field: 'id', direction: 'asc'}
              ],
              moreParams: {},
              products: this.propData.products,
            }
        },
        methods: {
            convertDate: function (dateVal) {
                var milliseconds = Date.parse(dateVal);
                var d = new Date(milliseconds);
                return d.toDateString();
            },
        },
        mounted: function () {
        },
        props: {
          propData: Object
        }
    }

</script>
