<template>

    <div class="row">
        <div class="col-sm-12">
            <h3>Delivery Tracking</h3>
        </div>

        <div class="col-sm-12" style="margin-top: 20px;" v-for="(product, indexTrace) in products" v-if="inventoryJob.job_order_id == product.job_order_id">
            <label htmlFor="itemname" class="col-sm-4 control-label">
                Item Name: {{product.name}}
            </label>
            <label htmlFor="quantity" class="col-sm-4 control-label">
                Expected Quantity: {{product.quantity}}
            </label>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Delivery Date</th>
                        <th>Delivered</th>
                        <th>Balance Needed</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    <tr v-for="(d, indexD) in detail.deliveries" v-if="d.product_id == product.id">
                        <td>{{convertDate(d.date)}}</td>
                        <td>{{d.delivered}}</td>
                        <td>{{balance(product.id, indexD)}}</td>
                        <td class="text-center">
                            <i class="fa fa-check-circle-o fa-2x text-success" /> &nbsp;
                            <i class="fa fa-times-circle-o fa-2x text-danger" @click="removeDelivery(indexTrace, indexD)" />
                        </td>
                    </tr>

                    <tr>
                        <td>{{dateToday}}</td>
                        <td>
                            <input type="text" class="form-control" :workIndex="indexTrace" :productId="product.id" @keyup.enter="handleSubmit" />
                        </td>
                        <td><span></span></td>
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
                detail: this.workDetail
            }
        },
        methods: {
            balance: function (product_id, indexD) {
                var qty = 0;
                for (var p = 0; p < this.products.length; p++) {
                    if (this.products[p].id == product_id) {
                        qty = this.products[p].quantity
                    }
                }
                for (var d = 0; d <= indexD; d++) {
                    if (this.detail.deliveries[d].product_id == product_id) {
                        qty = qty - this.detail.deliveries[d].delivered;
                    }
                }
                return qty;
            },
            convertDate: function (dateValue) {
                var milliseconds = Date.parse(dateValue);
                var d = new Date(milliseconds);
                return d.toDateString();
            },
            handleSubmit: function (e) {
                var workIndex = e.target.getAttribute('workIndex');
                var productId = e.target.getAttribute('productId');
                var deliveryVal = e.target.value;
                this.detail.deliveries.push({
                    product_id: productId,
                    date: this.dateToday,
                    delivered: deliveryVal
                });
                e.target.value = 0;
            },
            removeDelivery: function (indexTrace, indexDelivery) {
                this.detail.deliveries.splice(indexDelivery, 1);
            },
        },
        mounted: function () {
        },
        props: ['workDetail', 'products', 'propIJobId', 'inventoryJob']
    }

</script>