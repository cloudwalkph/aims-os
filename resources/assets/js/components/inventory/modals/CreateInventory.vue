<template>

    <div class="modal fade" id="modalCreateInventory" tabIndex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Create Inventory</h4>
                </div>
                <div class="modal-body">
                    <form id="createInventoryForm" @submit.prevent="handleSubmit">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="job_order_id">Job Order Number</label>
                                <v-select :on-change="selectJO" :options="joOptions"></v-select>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="category">Category</label>
                                <v-select :on-change="selectCategory" :options="categoryOptions"></v-select>
                            </div>
                            <div class="col-md-12 form-group text-input-container">
                                <label class="control-label">SKU</label>
                                <input type="text" name="product_code" placeholder="SKU-123" class="form-control" />
                            </div>
                            <div class="col-md-12 form-group text-input-container">
                                <label class="control-label">Product Name</label>
                                <input type="text" name="product_name" placeholder="Product Name" class="form-control" />
                            </div>
                            <div class="col-md-12 form-group text-input-container">
                                <label class="control-label">Quantity</label>
                                <input type="number" name="quantity" placeholder="0" class="form-control" />
                            </div>
                            <div class="col-md-12 form-group text-input-container">
                                <label class="control-label">Expiration Date</label>
                                <input type="text" name="expiration_date" placeholder="Title" class="expiration_date form-control" />
                            </div>
                            <div class="col-md-12 form-group text-input-container">
                                <label class="control-label">Status</label>
                                <v-select :on-change="selectStatus" :options="statusOptions"></v-select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="createInventoryForm">Save</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    module.exports = {
        data: function () {
            return {
              categoryOptions: [
                {
                  label: 'T Shirt',
                  value: 'tshirt',
                },
                {
                  label: 'Sandals',
                  value: 'sandals',
                },
                {
                  label: 'Pantalon',
                  value: 'pants',
                },
              ],
              categorySelected: null,
              event_datetime: '',
              joOptions: [],
              joSelected: null,
              statusOptions: [
                  {
                      label: 'New',
                      value: 'new'
                  },
                  {
                      label: 'Used',
                      value: 'used'
                  },
                  {
                      label: 'Damaged',
                      value: 'damaged'
                  },
              ],
              statusSelected: null
            }
        },
        methods: {
            handleSubmit: function (e) {
                var form = $(e.target)[0];

                var formData = new FormData(form);

                formData.append('job_order_id', this.joSelected);
                formData.append('category', this.categorySelected);
                formData.append('status', this.statusSelected);

                this.$http.post('/api/v1/inventory', formData)
                    .then(function (response) {
                        this.propData.internalInventory.push(formData);
                        $('#modalCreateInventory').modal('hide');
                        form.reset();
                        this.$events.fire('filter-reset');
                    })
                    .catch(function (e) {
                        console.log('error post jobs', e);
                    });
            },
            inputChange: function () {

            },
            selectJO: function (e) {
              this.joSelected = e.value;
            },
            selectCategory: function(e) {
              this.categorySelected = e.value;
            },
            selectStatus: function(e) {
              this.statusSelected = e.value;
            },
        },
        mounted: function () {
            $('.expiration_date').datetimepicker();
            for (let jo of this.propData.assignedJobs) {
              console.log(jo);
                if (jo) {
                    this.joOptions.push({
                        label: `${jo.job_order.job_order_no} : ${jo.job_order.project_name}`,
                        value: jo.job_order_id
                    });
                }
            }
        },
        props: ['propData']
    }

</script>
