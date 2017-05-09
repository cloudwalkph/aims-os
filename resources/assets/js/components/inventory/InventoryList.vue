<template>

    <div class="row">
        <div class="col-md-12">
            <h1 class="pull-left table-title">Inventory List</h1>
            <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modalCreateInventory">
                <i class="fa fa-plus" /> Create Inventory
            </button>
            <div class="content">
                <table id="inventoryList" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Job Order Number</th>
                            <th>Inventory Code</th>
                            <th>Inventory Name</th>
                            <th>Expiration Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in propData.internalInventory">
                            <td v-for="jo in propData.jobOrders" v-if="jo.id == item.job_order_id">
                                {{jo.job_order_no}}
                            </td>
                            <td>{{item.product_code}}</td>
                            <td>{{item.name}}</td>
                            <td>{{convertDate(item.expiration_date)}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <CreateInventoryModal :propData="propData"></CreateInventoryModal>
    </div>

</template>

<script>
    var CreateInventoryModal = require('./modals/CreateInventory.vue');

    module.exports = {
        components: {
            CreateInventoryModal
        },
        methods: {
            convertDate: function (dateVal) {
                var milliseconds = Date.parse(dateVal);
                var d = new Date(milliseconds);
                return d.toDateString();
            },
        },
        props: ['propData']
    }

</script>