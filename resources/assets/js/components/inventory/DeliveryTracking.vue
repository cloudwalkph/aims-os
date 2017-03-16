<template>

    <div class="row">
        <div class="col-sm-12">
            <h3>Delivery Tracking</h3>
        </div>

        <div class="col-sm-12" style="margin-top: 20px;" v-for="(item, indexTrace) in items">
            <label htmlFor="itemname" class="col-sm-4 control-label">
                <span v-for="product in products" v-if="item.product_code == product.product_code">
                    Item Name: {{product.name}}
                </span>
            </label>
            <label htmlFor="quantity" class="col-sm-4 control-label">
                <span v-for="product in products" v-if="item.product_code == product.product_code">
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

                    <tr v-for="(d, indexD) in item.deliveries">
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
                items: this.workDetail.items
            }
        },
        methods: {
            balance: function (indexTrace, indexD) {
                var product_code = this.items[indexTrace].product_code;
                var qty = 0;
                for (var p = 0; p < this.products.length; p++) {
                    if (this.products[p].product_code == product_code) {
                        qty = this.products[p].quantity
                    }
                }
                for (var d = 0; d <= indexD; d++) {
                    qty = qty - this.items[indexTrace].deliveries[d].delivered;
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
                this.items[workIndex].deliveries.push({
                    date: this.dateToday,
                    delivered: deliveryVal,
                    disposed: 0
                });
            },
            removeDelivery: function (indexTrace, indexDelivery) {
                this.items[indexTrace].deliveries.splice(indexDelivery, 1);
            },
        },
        props: ['workDetail', 'products']
    }

</script>