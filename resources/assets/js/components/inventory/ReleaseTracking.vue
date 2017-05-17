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
                  Current Stock on Hand: {{getProductsOnHand(product, dateToday)}}
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
                          <td>{{convertDate(r.date)}}</td>
                          <td>{{getProductsOnHand(product, r.date)}}</td>
                          <td>{{r.disposed}}</td>
                          <td>{{returned(product, r.date, r.disposed)}}</td>
                          <td><div v-if="r.status = 1">Approved</div><div v-else>Pending</div></td>
                          <td class="text-center">
                            <button type="button" class="btn btn-sm"><i class="glyphicon glyphicon-pencil"></i></button>
                            <button type="button" class="btn btn-sm" @click="removeDelivery(product, indexD)"><i class="glyphicon glyphicon-trash"></i></button>
                          </td>
                      </tr>

                      <tr>
                          <td>
                            <div class="input-group date datetimepickerRelease">
                                <input
                                  class="form-control"
                                  name="datetime"
                                  type="text"
                                />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                          </td>
                          <td>{{getProductsOnHand(product, dateToday)}}</td>
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
                frameSrc: '/inventory/print/release/' + this.propIJobId,
            }
        },
        methods: {
            convertDate: function (dateValue) {
                var milliseconds = Date.parse(dateValue);
                var d = new Date(milliseconds);
                return d.toDateString();
            },
            getProductsOnHand: function (product, rDate = Date()) {
                var total = 0;
                var rDateParsed = Date.parse(rDate);
                if(product.deliveries) {
                  for (delivery of product.deliveries) {
                    if (delivery.product_id == product.id) {
                      var deliveryDateParsed = Date.parse(delivery.date);
                      if (rDateParsed >= deliveryDateParsed) {
                        total = Number(total) + Number(delivery.delivered);
                      }
                    }
                  }
                }
                if(product.releases) {
                  for (release of product.releases) {
                    if (release.product_id == product.id) {
                      var releaseDateParsed = Date.parse(release.date);
                      if(rDateParsed > releaseDateParsed) {
                        total = Number(total) - Number(release.disposed);
                      }
                    }
                  }
                }
                return total;
            },
            returned: function (product, rDate, iDisposed = 0) {
                var productsOnHand = this.getProductsOnHand(product, rDate);
                return productsOnHand - iDisposed;
            },
            handleSubmit: function(e) {
              var form = $(e.target)[0];
                var workIndex = e.target.getAttribute('workIndex');
                this.products[workIndex].releases.push({
                    product_id: e.target.getAttribute('productId'),
                    date: this.convertDate(form.datetime.value),
                    disposed: form.disposedVal.value,
                    status: form.status.value,
                });
                form.disposedVal.value = '';
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
