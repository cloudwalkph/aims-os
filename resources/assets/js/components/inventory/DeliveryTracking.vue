<template>

    <div class="row">
        <div class="col-sm-12">
            <h3>Delivery Tracking</h3>
            <button class="btn btn-default pull-right" onclick="frames['inventoryDeliveryFrame'].print()">
                <i class="fa fa-print fa-lg"></i> Print Deliveries
            </button>
        </div>

        <div
            class="col-sm-12"
            v-if="products.length > 0"
        >
            <div
                style="margin-top: 20px;"
                v-for="(product, indexTrace) in products"
                :key="product.id"
            >
              <form
                @submit.prevent="handleSubmit"
                :productId="product.id"
                :workIndex="indexTrace"
              >
                <label htmlFor="itemname" class="col-sm-3 control-label">
                    Item Name: {{product.item_name}}
                </label>
                <label htmlFor="quantity" class="col-sm-3 control-label">
                    Expected Delivery Date: {{convertDate(product.expected_delivery_date)}}
                </label>
                <label htmlFor="quantity" class="col-sm-3 control-label">
                    Expected Quantity: {{product.expected_quantity}}
                </label>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Actual Delivery Date</th>
                            <th>Delivered</th>
                            <th>Balance Needed</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr
                          v-for="(d, indexD) in product.deliveries"
                          :key="indexD"
                          v-if="d.product_id == product.id"
                        >
                            <td>{{convertDate(d.delivery_date)}}</td>
                            <td>{{d.delivery_quantity}}</td>
                            <td>{{balance(product, indexD)}}</td>
                            <td class="text-center">
                              <button
                                class="btn btn-sm"
                                type="button"
                                data-toggle="modal"
                                data-target="#modalUpdateDelivery"
                                @click="onModalClick(indexTrace, indexD)"
                              ><i class="glyphicon glyphicon-pencil"></i></button>
                              <button
                                type="button"
                                class="btn btn-sm"
                                @click="removeDelivery(product.deliveries, indexD)"
                              ><i class="glyphicon glyphicon-trash"></i></button>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="form-group">
                                    <div class="input-group date datetimepickerDelivery">
                                        <input
                                          class="form-control"
                                          name="datetimeDelivery"
                                          type="text"
                                        />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <input
                                  type="text"
                                  class="form-control"
                                  name="deliveryVal"
                                />
                            </td>
                            <td><span></span></td>
                            <td class="text-center">
                              <button type="submit" class="btn btn-primary">Save</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
              </form>
            </div>
        </div>
        <div
            class="col-sm-12"
            v-else
        >No Products to show</div>

        <iframe name="inventoryDeliveryFrame" :src="frameSrc" style="width:0; height:0"></iframe>

        <div class="modal fade" id="modalUpdateDelivery" tabIndex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Edit Deliveries</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger hide">
                            This is an alert message
                        </div>

                        <form id="updateDeliveryForm" @submit.prevent="editDelivery">
                            <input type="hidden" name="deliveryIndex" />
                            <input type="hidden" name="productIndex" />
                            <div class="row">
                                <div class="col-md-12 form-group text-input-container">
                                    <label class="control-label">Delivery Quantity</label>
                                    <input
                                      type="number"
                                      name="delivery_quantity"
                                      id="delivery_quantity"
                                      placeholder="delivery quantity"
                                      class="form-control"
                                    />
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" form="updateDeliveryForm" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
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
                frameSrc: 'inventory/print/delivery/' + this.propIJobId,
            }
        },
        methods: {
            balance: function (product, indexD) {
                var qty = 0;
                  qty = product.expected_quantity
                for (var d = 0; d <= indexD; d++) {
                  qty = qty - product.deliveries[d].delivery_quantity;
                }
                return qty;
            },
            convertDate: function (dateValue) {
                var milliseconds = Date.parse(dateValue);
                var d = new Date(milliseconds);
                return d.toDateString();
            },
            handleSubmit: function (e) {
              var form = $(e.target)[0];
              var workIndex = e.target.getAttribute('workIndex');
              var product_id = e.target.getAttribute('productId');
              var delivered_quantity = form.deliveryVal.value;

              var postData = {
                product_id: product_id,
                delivery_quantity: delivered_quantity,
                delivery_date: form.datetimeDelivery.value,
              }

              this.$http.post('api/v1/inventory/delivery', postData)
                .then(function (response) {
                  form.reset();
                  this.products[workIndex].deliveries.push(postData);
                })
                .catch(function (e) {
                  console.log('error post inventory delivery', e);
                });
            },
            onModalClick: function(indexProduct, indexDelivery) {
                $('input[name="productIndex"]').val(indexProduct);
                $('input[name="deliveryIndex"]').val(indexDelivery);
            },
            editDelivery: function(e) {
                var form = $(e.target)[0];
                var productIndex = form.productIndex.value;
                var deliveryIndex = form.deliveryIndex.value;
                var delivery_quantity = form.delivery_quantity.value;
                var data = {
                  _method: 'PUT',
                  delivery_quantity: delivery_quantity,
                }

                this.$http.post('api/v1/inventory/delivery/' + this.products[productIndex].deliveries[deliveryIndex].id, data)
                  .then(function (response) {
                    this.products[productIndex].deliveries[deliveryIndex].delivery_quantity = delivery_quantity;
                  })
                  .catch(function (e) {
                    console.log('error edit inventory delivery', e);
                  });


                $('#modalUpdateDelivery').modal('hide');
                form.reset();
            },
            removeDelivery: function (deliveries, index) {
              var data = {
                _method: 'DELETE'
              }
              this.$http.post('api/v1/inventory/delivery/' + deliveries[index].id, data)
                .then(function (response) {
                  deliveries.splice(index, 1);
                })
                .catch(function (e) {
                  console.log('error delete inventory delivery', e);
                });

            },
        },
        mounted: function () {
          $('.datetimepickerDelivery').datetimepicker({
            minDate: moment()
          });
        },
        props: ['products', 'propIJobId']
    }

</script>
