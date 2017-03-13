<template>
    <div class="row">

        <div class="col-md-12">
            <div class="col-md-4 form-group text-input-container">
                <label class="control-label col-sm-12">Vehicle Type</label>
                <div class="col-md-12">
                    <v-select :on-change="typeSelected" :options="vehicleOptions"></v-select>
                </div>
            </div>

            <div class="col-md-4 form-group text-input-container">
                <label class="control-label col-sm-12">Venues</label>
                <div class="col-md-12">
                    <v-select :on-change="venueSelected" :options="venueOptions"></v-select>
                </div>
            </div>

            <div class="col-md-4 form-group text-input-container">
                <label class="control-label col-sm-12"># Vehicle Needed</label>
                <div class="col-md-12">
                    <input type="number" name="vehicle_needed"
                           @input="inputChange" v-bind:value="vehicle_needed" id="vehicle_needed"
                           placeholder="# Vehicle Needed" class="form-control" />
                </div>
            </div>
        </div>

        <div class="col-md-12">

            <div class="col-md-4 form-group text-input-container">
                <label class="control-label col-sm-12">Rate</label>
                <div class="col-md-12">
                    <input type="number" name="rate"
                           @input="inputChange" v-bind:value="rate" id="rate"
                           placeholder="Rate" class="form-control" />
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
                vehicleOptions: [],
                vehicle_type_id: '',
                venueOptions: [],
                venue_id: '',
                vehicle_needed: '',
                rate: '',
                remarks: ''
            }
        },
        mounted() {
            this.getVenues()
            this.getVehicleTypes()
        },
        methods: {
            resetForm() {
                this.job_order_id = ''
                this.vehicle_needed = ''
                this.rate = ''
                this.remarks = ''
            },
            inputChange(e) {
                this[e.target.id] = e.target.value
            },
            typeSelected(val) {
                this.vehicle_type_id = val.value
            },
            getVehicleTypes() {
                this.$http.get('/api/v1/vehicle-types/all').then(response => {
                    let vehicle_types = response.data;

                    for (let vehicle_type of vehicle_types) {
                        this.vehicleOptions.push({label: `${vehicle_type.name}`, value: vehicle_type.id});
                    }
                }, error => {
                        console.log(error)
                });
            },
            venueSelected(val) {
                this.venue_id = val.value
            },
            getVenues() {
                this.$http.get('/api/v1/venues/all').then(response => {
                    let venues = response.data;

                    for (let venue of venues) {
                        this.venueOptions.push({label: `${venue.category} : ${venue.venue}`, value: venue.id});
                    }
                }, error => {
                    console.log(error)
                });
            },
            saveProject(e) {
                let jobOrderId = $('#jobOrderId').val();
                let data = {
                    job_order_id: jobOrderId,
                    vehicle_type_id: this.vehicle_type_id,
                    venue_id: this.venue_id,
                    vehicle_needed: this.vehicle_needed,
                    rate: this.rate,
                    remarks: this.remarks,
                    department_id: "7" // to set as AE
                }

                let url = `/api/v1/job-order-vehicles`;
                this.$http.post(url, data).then(response => {

                    this.$events.fire('reload-table')
                    this.resetForm()
                }, error => {
                    console.log(error)
                })
            }
        }
    }
</script>
