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
          v-for="(product, indexTrace) in products"
          :key="product.id"
          v-if="inventoryJob.job_order_id == product.job_order_id"
        >
            <label htmlFor="itemname" class="col-sm-4 control-label">
                Item Name: {{product.name}}
            </label>
            <label htmlFor="quantity" class="col-sm-4 control-label">
                Expected Quantity: {{product.quantity}}
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

                    <tr
                      v-for="(r, indexD) in detail.releases"
                      :key="indexD"
                      v-if="r.product_id == product.id"
                    >
                        <td>{{convertDate(r.date)}}</td>
                        <td>{{productsOnHand(detail, product.id, r.date)}}</td>
                        <td>{{r.disposed}}</td>
                        <td>{{returned(detail, product.id, r.date, r.disposed)}}</td>
                        <td>{{r.status}}</td>
                        <td class="text-center">
                            <i class="fa fa-check-circle-o fa-2x text-success" /> &nbsp;
                            <i class="fa fa-times-circle-o fa-2x text-danger" />
                        </td>
                    </tr>

                    <tr>
                        <td>{{dateToday}}</td>
                        <td>{{productsOnHand(detail, product.id, dateToday)}}</td>
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
                detail: this.workDetail,
            }
        },
        methods: {
            convertDate: function (dateValue) {
                var milliseconds = Date.parse(dateValue);
                var d = new Date(milliseconds);
                return d.toDateString();
            },
            productsOnHand: function (detail, product_id, rDate = Date()) {
                var total = 0;
                var rDateParsed = Date.parse(rDate);
                for (delivery of detail.deliveries) {
                    if (delivery.product_id == product_id) {
                        var deliveryDateParsed = Date.parse(delivery.date);
                        if (deliveryDateParsed <= rDateParsed) {
                            total = Number(total) + Number(delivery.delivered);
                        }
                    }
                }
                for (release of detail.releases) {
                    if (release.product_id == product_id) {
                        var releaseDateParsed = Date.parse(release.date);
                        if(releaseDateParsed < rDateParsed) {
                            total = Number(total) - Number(release.disposed);
                        }
                    }
                }
                return total;
            },
            returned: function (detail, product_id, rDate, iDisposed = 0) {
                var products = this.productsOnHand(detail, product_id, rDate);
                return products - iDisposed;
            }
        },
        mounted: function () {
        },
        props: ['workDetail', 'products', 'propIJobId', 'inventoryJob']
    }

</script>
