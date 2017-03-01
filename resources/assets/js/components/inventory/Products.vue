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
                        <td>{{product.jobOrderNo}}</td>
                        <td>
                            <div v-for="jobOrder in propData.jobOrders" v-if="product.jobOrderNo == jobOrder.jobOrderNo">
                                <div v-for="project in propData.projects" v-if="jobOrder.projectID == project.projectID">
                                    {{project.projectName}}
                                </div>
                            </div>
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
