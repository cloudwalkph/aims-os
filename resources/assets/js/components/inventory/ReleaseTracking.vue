<template>

    <div class="row">
        <div class="col-sm-12">
            <h3>
                Release Tracking
                <button class="btn btn-default pull-right" onclick="frames['inventoryReleaseFrame'].print()">
                    <i class="fa fa-print fa-lg"></i> Print Releases
                </button>
            </h3>
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
              <label htmlFor="itemname" class="col-sm-4 control-label">
                  Item Name: {{product.item_name}}
              </label>
              <label htmlFor="quantity" class="col-sm-4 control-label">
                  Current Stock on Hand: {{getProductsOnHand(product)}}
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
                        v-for="(r, indexD) in product.releases"
                        :key="indexD"
                      >
                          <td>{{convertDate(r.release_date)}}</td>
                          <td>{{getProductsOnHand(product, r.release_date)}}</td>
                          <td>{{r.dispose_quantity}}</td>
                          <td>{{r.return_quantity}}</td>
                          <td><div v-if="r.status = 1">Approved</div><div v-else>Pending</div></td>
                          <td class="text-center">
                            <button type="button" class="btn btn-sm"><i class="glyphicon glyphicon-pencil"></i></button>
                            <button type="button" class="btn btn-sm" @click="removeRelease(product, indexD)"><i class="glyphicon glyphicon-trash"></i></button>
                          </td>
                      </tr>

                      <tr>
                          <td>
                            <div class="input-group date datetimepickerRelease">
                                <input
                                  class="form-control"
                                  name="datetimeRelease"
                                  type="text"
                                />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                          </td>
                          <td>{{getProductsOnHand(product)}}</td>
                          <td><input type="text" name="disposedVal" class="form-control" /></td>
                          <td><input type="text" name="returnedVal" class="form-control" /></td>
                          <td>
                              <select name="status" class="form-control">
                                  <option value="1">Approved</option>
                                  <option value="0">Pending</option>
                              </select>
                          </td>
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
        >No Products to Show</div>

        <iframe name="inventoryReleaseFrame" :src="frameSrc" style="width:0; height:0"></iframe>
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
                frameSrc: 'inventory/print/release/' + this.propIJobId,
            }
        },
        methods: {
            convertDate: function (dateValue) {
                var milliseconds = Date.parse(dateValue);
                var d = new Date(milliseconds);
                return d.toDateString();
            },
            getProductsOnHand: function (product, rDate = Date()) {
              var deliveries = 0,
                releases = 0,
                total = 0,
                rDateParsed = Date.parse(rDate);

                if(product.releases.length > 0) {
                  for (release of product.releases) {
                    deliveries = 0;
                    var releaseDateParsed = Date.parse(release.release_date);

                    for (delivery of product.deliveries) {
                      var deliveryDateParsed = Date.parse(delivery.delivery_date);
                      if (deliveryDateParsed < releaseDateParsed && rDateParsed > deliveryDateParsed) {
                        deliveries += Number(delivery.delivery_quantity);
                      }
                    }

                    if (rDateParsed > releaseDateParsed) {
                      releases += Number(release.dispose_quantity) - Number(release.return_quantity);
                    }
                  }
                } else {
                  for (delivery of product.deliveries) {
                    var deliveryDateParsed = Date.parse(delivery.delivery_date);
                    if (rDateParsed > deliveryDateParsed) {
                      deliveries += Number(delivery.delivery_quantity);
                    }
                  }
                }

                total = deliveries - releases;

                return total;
            },
            returned: function (product, rDate, iDisposed = 0) {
                var productsOnHand = this.getProductsOnHand(product, rDate);
                return productsOnHand - iDisposed;
            },
            handleSubmit: function(e) {
              var form = $(e.target)[0];
              var workIndex = e.target.getAttribute('workIndex');
              var product_id = e.target.getAttribute('productId');
              var dispose_quantity = form.disposedVal.value;
              var return_quantity = form.returnedVal.value

              var postData = {
                product_id: product_id,
                dispose_quantity: dispose_quantity,
                return_quantity: return_quantity,
                release_date: form.datetimeRelease.value,
              }

              this.$http.post('api/v1/inventory/release', postData)
                .then(function (response) {
                  form.reset();
                  this.products[workIndex].releases.push(postData);
                })
                .catch(function (e) {
                  console.log('error post inventory release', e);
                });
            },
            removeRelease: function(product, index) {
              product.releases.splice(index, 1);
            },
        },
        mounted: function () {
          $('.datetimepickerRelease').datetimepicker({
            defaultDate: moment()
          });
        },
        props: ['products', 'propIJobId']
    }

</script>
