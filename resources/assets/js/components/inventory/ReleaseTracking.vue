<template>

    <div class="row">
        <div class="col-sm-12">
            <h3>
                Release Tracking
                <i class="fa fa-print fa-lg pull-right" />
            </h3>
        </div>
        <div class="col-sm-12" style="margin-top: 20px;" v-for="(item, index) in items">
            <label htmlFor="itemname" class="col-sm-4 control-label">
                <span v-for="product in products" v-if="item.product_id == product.id">
                    Item Name: {{product.name}}
                </span>
            </label>
            <label htmlFor="quantity" class="col-sm-4 control-label">
                <span v-for="product in products" v-if="item.product_id == product.id">
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

                    <tr v-for="(r, indexD) in item.releases">
                        <td>{{convertDate(r.date)}}</td>
                        <td>{{r.delivered}}</td>
                        <td>{{r.disposed}}</td>
                        <td>{{returned(r)}}</td>
                        <td>{{r.status}}</td>
                        <td class="text-center">
                            <i class="fa fa-check-circle-o fa-2x text-success" /> &nbsp;
                            <i class="fa fa-times-circle-o fa-2x text-danger" />
                        </td>
                    </tr>

                    <tr>
                        <td>{{dateToday}}</td>
                        <td>{{productsOnHand(index)}}</td>
                        <td><input type="text" class="form-control" /></td>
                        <td><input type="text" class="form-control" /></td>
                        <td>
                            <select class="form-control">
                                <option>Approved</option>
                                <option>Pending</option>
                            </select>
                        </td>
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
        data: function () {
            return {
                items: this.workDetail.items
            }
        },
        methods: {
            convertDate: function (dateValue) {
                var milliseconds = Date.parse(dateValue);
                var d = new Date(milliseconds);
                return d.toDateString();
            },
            productsOnHand: function (index) {
                for(delivery of this.items[index].deliveries) {
                    console.log(delivery);
                }
            },
            returned: function (r) {
                return r.delivered - r.disposed;
            }
        },
        mounted: function () {
        },
        props: ['workDetail', 'products']
    }

</script>