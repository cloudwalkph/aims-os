<template>
    <div class="row">

        <div class="col-md-12">
            <div class="col-md-4 form-group text-input-container">
                <label class="control-label col-sm-12">Meal Type</label>
                <div class="col-md-12">
                    <v-select :on-change="typeSelected" :options="mealOptions"></v-select>
                </div>
            </div>

            <div class="col-md-4 form-group text-input-container">
                <label class="control-label col-sm-12">Quantity</label>
                <div class="col-md-12">
                    <input type="number" name="quantity"
                           @input="inputChange" v-bind:value="quantity" id="quantity"
                           placeholder="Quantity" class="form-control" />
                </div>
            </div>

            <div class="col-md-4 form-group text-input-container">
                <label class="control-label col-sm-12">Serving Time</label>
                <div class="col-md-12">
                    <input type="time" name="serving_time"
                           @input="inputChange" v-bind:value="serving_time" id="serving_time"
                           placeholder="Serving Time" class="form-control" />
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="col-md-4 form-group text-input-container">
                <label class="control-label col-sm-12">Pickup By</label>
                <div class="col-md-12">
                    <input type="text" name="pickup_by"
                           @input="inputChange" v-bind:value="pickup_by" id="pickup_by"
                           placeholder="Pickup By" class="form-control" />
                </div>
            </div>

            <div class="col-md-4 form-group text-input-container">
                <label class="control-label col-sm-12">Remarks</label>
                <div class="col-md-12">
                    <input type="text" name="remarks"
                           @input="inputChange" v-bind:value="remarks" id="remarks"
                           placeholder="Remarks" class="form-control" />
                </div>
            </div>

            <div class="col-md-4 form-group select-input-container">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-add btn-block" @click="saveProject">Add </button>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import vSelect from 'vue-select'

    Vue.component('v-select', vSelect)
    export default {
        data() {
            return {
                meal_types: [],
                mealOptions: [],
                meal_type_id: '',
                quantity: '',
                serving_time: '',
                pickup_by: '',
                remarks: ''
            }
        },
        mounted() {
            this.getManpowerTypes()
        },
        methods: {
            resetForm() {
                this.job_order_id = ''
                this.quantity = ''
                this.serving_time = ''
                this.pickup_by = ''
                this.remarks = ''
            },
            inputChange(e) {
                this[e.target.id] = e.target.value
            },
            typeSelected(val) {
                this.meal_type_id = val.value
            },
            getManpowerTypes() {
                this.$http.get('/api/v1/meal-types').then(response => {
                    let meal_types = response.data;

                    for (let meal_type of meal_types) {
                        this.mealOptions.push({label: `${meal_type.name}`, value: meal_type.id});
                    }
                }, error => {
                        console.log(error)
                });
            },
            saveProject(e) {
                let jobOrderId = $('#jobOrderId').val();
                let data = {
                    job_order_id: jobOrderId,
                    meal_type_id: this.meal_type_id,
                    quantity: this.quantity,
                    serving_time: this.serving_time,
                    pickup_by: this.pickup_by,
                    remarks: this.remarks
                }

                let url = `/api/v1/job-order-meals`;
                this.$http.post(url, data).then(response => {

                    toastr.success('Successfully added meal request', 'Success')
                    this.$events.fire('reload-table')
                    this.resetForm()
                }, error => {
                    toastr.error('Failed in adding meal request', 'Error')
                    console.log(error)
                })
            }
        }
    }
</script>
