<template>

    <div class="row">
        <div class="col-sm-12" style="margin-top: 20px;">
            <h3>Delivery Tracking</h3>
            <label htmlFor="itemname" class="col-sm-4 control-label">Item Name: Ponds for Men</label>
            <label htmlFor="quantity" class="col-sm-4 control-label">Expected Quantity: 100,000</label>
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

                    <tr v-for="delivery in deliveries">
                        <td>{{delivery.date}}</td>
                        <td>{{delivery.delivered}}</td>
                        <td>{{delivery.balance}}</td>
                        <td class="text-center">
                            <i class="fa fa-check-circle-o fa-2x text-success" /> &nbsp;
                            <i class="fa fa-times-circle-o fa-2x text-danger" />
                        </td>
                    </tr>

                <tr>
                    <td>January 26, 2017</td>
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

        <div class="col-sm-12" style="margin-top: 20px;">
            <label htmlFor="itemname" class="col-sm-4 control-label">Item Name: Ponds for Women</label>
            <label htmlFor="quantity" class="col-sm-4 control-label">Expected Quantity: 100,000</label>
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

                    <tr v-for="delivery in deliveries">
                        <td>{{delivery.date}}</td>
                        <td>{{delivery.delivered}}</td>
                        <td>{{delivery.balance}}</td>
                        <td class="text-center">
                            <i class="fa fa-check-circle-o fa-2x text-success" /> &nbsp;
                            <i class="fa fa-times-circle-o fa-2x text-danger" />
                        </td>
                    </tr>

                <tr>
                    <td>January 26, 2017</td>
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
        props: {
            deliveries: {
                type: Array
            }
        }
    }
</script>