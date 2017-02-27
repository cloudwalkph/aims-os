<template>

    <div class="row">
        <div class="col-md-12">
            <h1 class="pull-left table-title">Inventory List</h1>
            <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#createIventory">
                <i class="fa fa-plus" /> Create Inventory
            </button>
            <div class="content">
                <table id="inventoryList" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Job Order Number</th>
                            <th>Inventory Code</th>
                            <th>Iventory Name</th>
                            <th>Expiration Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="product in products">
                            <td>{{product.jobOrderNo}}</td>
                            <td>{{product.projectName}}</td>
                            <td>{{product.itemName}}</td>
                            <td>{{product.productsOnHand}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <CreateInventoryModal></CreateInventoryModal>
    </div>

</template>

<script>
    var CreateInventoryModal = require('./modals/CreateInventory.vue');

    module.exports = {
        data: function() {
            return {
                products: [
                    {
                        jobOrderNo: 2006456435,
                        projectName: 'Ponds Activations',
                        itemName: 'Ponds Men',
                        productsOnHand: '250000'
                    }
                ]
            }
        },
        components: {
            CreateInventoryModal
        }
    }
</script>