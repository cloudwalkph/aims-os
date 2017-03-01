<template>

    <div class="row">
        <div class="col-sm-12">
            <h3>Delivery Tracking</h3>
        </div>

        <div 
            class="col-sm-12" 
            style="margin-top: 20px;" 
            v-for="(trace, indexTrace) in traces"
        >
            <label htmlFor="itemname" class="col-sm-4 control-label">
                <span v-for="product in products" v-if="trace.productID == product.productID">
                    Item Name: {{product.itemName}}
                </span>
            </label>
            <label htmlFor="quantity" class="col-sm-4 control-label">Expected Quantity: {{trace.productsOnHand}}</label>
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

                    <tr v-for="(delivery, indexDeliveries) in trace.deliveries">
                        <td>{{convertDate(delivery.date)}}</td>
                        <td>{{delivery.delivered}}</td>
                        <td>{{delivery.balance}}</td>
                        <td class="text-center">
                            <i class="fa fa-check-circle-o fa-2x text-success" /> &nbsp;
                            <i class="fa fa-times-circle-o fa-2x text-danger" @click="removeDelivery(indexTrace, indexDeliveries)" />
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
            dateToday: function() {
                var d = new Date();
                return d.toDateString();
            }
        },
        methods: {
            removeDelivery: function(indexTrace, indexDelivery) {
                this.traces[indexTrace].deliveries.splice(indexDelivery, 1);
            },
            convertDate: function(dateValue) {
                var milliseconds = Date.parse(dateValue);
                var d = new Date(milliseconds);
                return d.toDateString();
            },
            handleSubmit: function(e) {
                var workIndex = e.target.getAttribute('workIndex');
                var lastDeliveryIndex = this.traces[workIndex].deliveries.length - 1;
                var currBalance = this.traces[workIndex].productsOnHand;
                if(this.traces[workIndex].deliveries.length) {
                    var currBalance = this.traces[workIndex].deliveries[lastDeliveryIndex].balance;
                }
                var deliveryVal = e.target.value;
                var nextBalance = currBalance - deliveryVal;
                this.traces[workIndex].deliveries.push({
                    date: this.dateToday,
                    delivered: deliveryVal,
                    balance: nextBalance
                });
                e.target.value = '';
            }
        },
        props: ['products', 'traces']
    }
</script>