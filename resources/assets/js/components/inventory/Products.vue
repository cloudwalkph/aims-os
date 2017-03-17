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

                    <tr v-for="(product, index) in products">
                        <td>{{product.job_order_no}}</td>
                        <td>{{product.project_name}}</td>
                        <td>{{product.name}}</td>
                        <td>{{product.quantity}}</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

</template>

<script>
    module.exports = {
        data: function () {
            return {
                products: this.propData.products
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
        props: ['propData']
    }

</script>