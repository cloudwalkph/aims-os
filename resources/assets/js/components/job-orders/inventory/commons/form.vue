<template>
    <div class="row">
    <form @submit.prevent="validateBeforeSubmit">

        <div class="col-md-4 col-md-sm-6 col-xs-12 form-group text-input-container" :class="{'has-error': errors.has('item_name') }">
            <label class="control-label col-sm-12" for="item_name">Item Name <span class="required-field">*</span></label>
            <div class="col-md-12">
                <input type="text" name="item_name" required placeholder="Item Name"
                       id="item_name" class="form-control" v-model="item_name" v-validate="'required'" 
                       @input="inputChange" v-bind:value="item_name"/>
                   <span v-show="errors.has('item_name')" class="help-block"><strong>{{ errors.first('item_name') }}</strong></span>
            </div>
        </div>

        <div class="col-md-4 col-md-sm-6 col-xs-12 form-group text-input-container" :class="{'has-error': errors.has('expected_quantity') }">
            <label class="control-label col-sm-12" for="expected_quantity">Expected Quantity <span class="required-field">*</span></label>
            <div class="col-md-12">
                <input type="number" name="expected_quantity" required placeholder="Expected Quantity"
                       id="expected_quantity" class="form-control" v-model="expected_quantity" v-validate="'required'" 
                       @input="inputChange" v-bind:value="expected_quantity"/>
                   <span v-show="errors.has('expected_quantity')" class="help-block"><strong>{{ errors.first('expected_quantity') }}</strong></span>
            </div>
        </div>

        <div class="col-md-4 col-md-sm-6 col-xs-12 form-group text-input-container" :class="{'has-error': errors.has('expected_delivery_date') }">
            <label class="control-label col-sm-12" for="expected_quantity">Expected Delivery Date <span class="required-field">*</span></label>
            <div class="col-md-12">
                <input type="text" name="expected_delivery_date" required placeholder="Expected Delivery Date"
                       id="expected_delivery_date" class="form-control" v-model="expected_delivery_date" v-validate="'required'" 
                       @input="inputChange" v-bind:value="expected_delivery_date"/>
                   <span v-show="errors.has('expected_delivery_date')" class="help-block"><strong>{{ errors.first('expected_delivery_date') }}</strong></span>
            </div>
        </div>

        <div class="col-md-12 text-right form-group select-input-container">
            <button type="submit" style="width: 200px" class="btn btn-primary btn-add">Save</button>
        </div>
    </form>

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
            $('#expected_delivery_date').on('dp.change', (newDate, oldDate) => {
                this.expected_delivery_date = newDate.date.format("YYYY-MM-DD hh:mm a");
            });
        },
        methods: {
            validateBeforeSubmit(e) {
                this.$validator.validateAll();
                if (!this.errors.any()) {
                    this.saveProject()
                }
            },
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
                    expected_delivery_date:  moment(this.expected_delivery_date, "YYYY-MM-DD hh:mm a").format("YYYY-MM-DD HH:mm:ss"),
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
