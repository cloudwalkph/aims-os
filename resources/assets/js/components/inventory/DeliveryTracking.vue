<template>

    <div class="row">
        <div class="col-sm-12">
            <h3>Delivery Tracking</h3>
        </div>

        <div class="col-sm-12" style="margin-top: 20px;" v-for="(delivery, indexTrace) in deliveries">
            <label htmlFor="itemname" class="col-sm-4 control-label">
                <span v-for="product in products" v-if="delivery.product_id == product.id">
                    Item Name: {{product.name}}
                </span>
            </label>
            <label htmlFor="quantity" class="col-sm-4 control-label">
                <span v-for="product in products" v-if="delivery.product_id == product.id">
                    Expected Quantity: {{product.quantity}}
                </span>
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

                    <tr v-for="(d, indexD) in delivery.data">
                        <td>{{convertDate(d.date)}}</td>
                        <td>{{d.delivered}}</td>
                        <td>{{balance(indexTrace, indexD)}}</td>
                        <td class="text-center">
                            <i class="fa fa-check-circle-o fa-2x text-success" /> &nbsp;
                            <i class="fa fa-times-circle-o fa-2x text-danger" @click="removeDelivery(indexTrace, indexD)" />
                        </td>
                    </tr>

                    <tr>
                        <td>{{dateToday}}</td>
                        <td>
                            <input type="text" class="form-control" :workIndex="indexTrace" @keyup.enter="handleSubmit" />
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
                deliveries: this.workDetail.deliveries
            }
        },
        methods: {
            balance: function (indexTrace, indexD) {
                var product_id = this.deliveries[indexTrace].product_id;
                var qty = 0;
                for (var p = 0; p < this.products.length; p++) {
                    if (this.products[p].id == product_id) {
                        qty = this.products[p].quantity
                    }
                }
                for (var d = 0; d <= indexD; d++) {
                    qty = qty - this.deliveries[indexTrace].data[d].delivered;
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
                var deliveryVal = e.target.value;
                this.deliveries[workIndex].data.push({
                    date: this.dateToday,
                    delivered: deliveryVal,
                    disposed: 0
                });
            },
            removeDelivery: function (indexTrace, indexDelivery) {
                this.deliveries[indexTrace].data.splice(indexDelivery, 1);
            },
        },
        props: ['workDetail', 'products']
    }

</script>