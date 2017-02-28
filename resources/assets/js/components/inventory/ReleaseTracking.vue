<template>

    <div class="row">
        <div class="col-sm-12">
            <h3>
                Release Tracking
                <i class="fa fa-print fa-lg pull-right" />
            </h3>
        </div>
        <div 
            class="col-sm-12" 
            style="margin-top: 20px;" 
            v-for="(trace, index) in traces"
        >
            <label htmlFor="itemname" class="col-sm-4 control-label">
                <span v-for="product in products" v-if="trace.productID == product.productID">
                    Item Name: {{product.itemName}}
                </span>
            </label>
            <label htmlFor="quantity" class="col-sm-4 control-label">Expected Quantity: {{trace.productOnHand}}</label>
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Products on Hand</th>
                    <th>Disposed</th>
                    <th>Returned</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>

                <tbody>

                    <tr v-for="r in trace.releases">
                        <td>{{r.date}}</td>
                        <td>{{r.productsOnHand}}</td>
                        <td>{{r.disposed}}</td>
                        <td>{{r.returned}}</td>
                        <td>{{r.status}}</td>
                        <td class="text-center">
                            <i class="fa fa-check-circle-o fa-2x text-success" /> &nbsp;
                            <i class="fa fa-times-circle-o fa-2x text-danger" />
                        </td>
                    </tr>

                <tr>
                    <td>January 26, 2017</td>
                    <td><input type="text" class="form-control"/></td>
                    <td><input type="text" class="form-control"/></td>
                    <td><input type="text" class="form-control"/></td>
                    <td><input type="text" class="form-control"/></td>
                    <td class="text-center">
                        <i class="fa fa-check-circle-o fa-2x text-success" /> &nbsp;
                        <i class="fa fa-times-circle-o fa-2x text-danger" />
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

</template>

<script>
    module.exports = {
        props: ['products', 'traces']
    }
</script>