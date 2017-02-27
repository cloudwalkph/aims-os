<template>

    <div class="row">
        <div class="col-md-12">
            <h1>Product List</h1>
            <table id="productsList" class="table table-striped">
                <thead>
                    <tr>
                        <th>Job Order Number</th>
                        <th>Project Name</th>
                        <th>Item Name</th>
                        <th>Products on Hand</th>
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

</template>

<script>
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
        }
    }
</script>
