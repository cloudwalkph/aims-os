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

                    <tr v-for="(product, index) in propData.products">
                        <td>
                            <span v-for="jobOrder in propData.jobOrders" v-if="product.job_order_id == jobOrder.id">
                                {{jobOrder.job_order_no}}
                            </span>
                        </td>
                        <td>
                            <span v-for="jobOrder in propData.jobOrders" v-if="product.job_order_id == jobOrder.id">
                                {{jobOrder.project_name}}
                            </span>
                        </td>
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
        props: ['propData']
    }

</script>