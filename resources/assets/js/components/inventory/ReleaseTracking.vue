<template>

    <div class="row">
        <div class="col-sm-12">
            <h3>
                Release Tracking
                <i class="fa fa-print fa-lg pull-right" />
            </h3>
        </div>
        <div class="col-sm-12" style="margin-top: 20px;" v-for="(release, index) in releases">
            <label htmlFor="itemname" class="col-sm-4 control-label">
                <span v-for="product in products" v-if="release.productID == product.productID">
                    Item Name: {{product.itemName}}
                </span>
            </label>
            <label htmlFor="quantity" class="col-sm-4 control-label">
                <span v-for="product in products" v-if="release.product_id == product.id">
                    Expected Quantity: {{product.quantity}}
                </span>
            </label>
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

                    <tr v-for="r in release.data">
                        <td>{{convertDate(r.date)}}</td>
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
                        <td>{{dateToday}}</td>
                        <td><input type="text" class="form-control" /></td>
                        <td><input type="text" class="form-control" /></td>
                        <td><input type="text" class="form-control" /></td>
                        <td><input type="text" class="form-control" /></td>
                        <td class="text-center">

                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

</template>

<script>
    module.exports = {
        computed: {
            dateToday: function () {
                var d = new Date();
                return d.toDateString();
            }
        },
        methods: {
            convertDate: function (dateValue) {
                var milliseconds = Date.parse(dateValue);
                var d = new Date(milliseconds);
                return d.toDateString();
            },
        },
        props: ['products', 'releases']
    }

</script>