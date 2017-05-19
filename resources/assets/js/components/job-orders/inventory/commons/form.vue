<template>
    <div class="row">

        <div class="col-md-4 col-md-sm-6 col-xs-12 form-group text-input-container">
            <label class="control-label col-sm-12" for="item_name">Item Name <span class="required-field">*</span></label>
            <div class="col-md-12">
                <input type="text" name="item_name" required placeholder="Item Name"
                       id="item_name" class="form-control"
                       @input="inputChange" v-bind:value="item_name"/>
            </div>
        </div>

        <div class="col-md-4 col-md-sm-6 col-xs-12 form-group text-input-container">
            <label class="control-label col-sm-12" for="expected_quantity">Expected Quantity <span class="required-field">*</span></label>
            <div class="col-md-12">
                <input type="number" name="expected_quantity" required placeholder="Expected Quantity"
                       id="expected_quantity" class="form-control"
                       @input="inputChange" v-bind:value="expected_quantity"/>
            </div>
        </div>

        <div class="col-md-4 col-md-sm-6 col-xs-12 form-group text-input-container">
            <label class="control-label col-sm-12" for="expected_quantity">Expected Delivery Date</label>
            <div class="col-md-12">
                <input type="date" name="expected_delivery_date" required placeholder="Expected Delivery Date"
                       id="expected_delivery_date" class="form-control"
                       @input="inputChange" v-bind:value="expected_delivery_date"/>
            </div>
        </div>

        <div class="col-md-12 text-right form-group select-input-container">
            <button type="submit" style="width: 200px" class="btn btn-primary btn-add" @click="saveProject">Save</button>
        </div>

    </div>
</template>

<script>
    import vSelect from 'vue-select'

    Vue.component('v-select', vSelect)
    export default {
        data() {
            return {
                item_name: '',
                expected_quantity: '',
                job_order_id: '',
                expected_delivery_date: ''
            }
        },
        mounted() {
        },
        methods: {
            resetForm() {
                this.item_name = ''
                this.expected_quantity = ''
                this.expected_delivery_date = ''
            },
            inputChange(e) {
                this[e.target.id] = e.target.value
            },
            saveProject(e) {
                let jobOrderId = $('#jobOrderId').val();
                let data = {
                    job_order_id: jobOrderId,
                    expected_quantity: this.expected_quantity,
                    item_name: this.item_name,
                    expected_delivery_date: this.expected_delivery_date
                }

                let url = `/api/v1/job-order-inventory`;
                this.$http.post(url, data).then(response => {

                    $('#joFrame').attr('src','/ae/jo/details/'+jobOrderId+'/preview'); 
                    this.$events.fire('reload-table')
                    this.resetForm()
                    toastr.success('Successfully added inventory request', 'Success')
                }, error => {
                    toastr.error('Failed in adding inventory request', 'Error')
                    console.log(error)
                })
            }
        }
    }
</script>
