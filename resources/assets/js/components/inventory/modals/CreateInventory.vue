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
                                <v-select :on-change="joSelected" :options="joOptions"></v-select>
                            </div>
                            <div class="col-md-12 form-group text-input-container">
                                <label class="control-label">Product Code</label>
                                <input type="text" name="product_code" placeholder="Product Code" class="form-control" />
                            </div>
                            <div class="col-md-12 form-group text-input-container">
                                <label class="control-label">Product Name</label>
                                <input type="text" name="product_name" placeholder="Product Name" class="form-control" />
                            </div>
                            <div class="col-md-12 form-group text-input-container">
                                <label class="control-label">Expiration Date</label>
                                <input type="text" name="expiration_date" placeholder="Title" class="form-control" />
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
                event_datetime: '',
                joOptions: [],
                selected_job_order: null,
            }
        },
        methods: {
            handleSubmit: function (e) {
                var form = $(e.target)[0];

                var postData = {
                    job_order_id: this.selected_job_order,
                    product_code: form.product_code.value,
                    name: form.product_name.value,
                    expiration_date: form.expiration_date.value,
                }

                this.$http.post('/api/v1/inventory', postData)
                    .then(function (response) {
                        this.propData.internalInventory.push(
                            {
                                id: response.data.id,
                                job_order_id: postData.job_order_id,
                                product_code: postData.product_code,
                                name: postData.name,
                                expiration_date: postData.expiration_date,
                            }
                        );
                        $('#modalCreateInventory').modal('hide');
                        form.reset();
                    })
                    .catch(function (e) {
                        console.log('error post jobs', e);
                    });
            },
            inputChange: function () {

            },
            joSelected: function (e) {
                this.selected_job_order = e.value;
            },
        },
        mounted: function () {
            for (let jo of this.propData.jobOrders) {
                if (jo) {
                    this.joOptions.push({
                        label: `${jo.job_order_no} : ${jo.project_name}`,
                        value: jo.id
                    });
                }
            }
        },
        props: ['propData']
    }

</script>