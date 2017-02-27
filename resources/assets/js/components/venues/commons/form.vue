<template>
    <div class="modal fade" id="createVenue" tabIndex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Venue Form</h4>
                </div>
                <div class="modal-body">

                    <form>
                        <div class="row">
                            <div class="col-md-6 form-group text-input-container">
                                <label class="control-label">Category</label>
                                <input type="text" name="category" id="category"
                                       @input="inputChange" v-bind:value="category"
                                       placeholder="Category" class="form-control" />
                            </div>

                            <div class="col-md-6 form-group text-input-container">
                                <label class="control-label">SubCategory</label>
                                <input type="text" name="subcategory" id="subcategory"
                                       @input="inputChange" v-bind:value="subcategory"
                                       placeholder="SubCategory" class="form-control" />
                            </div>

                            <div class="col-md-6 form-group text-input-container">
                                <label class="control-label">Venue</label>
                                <input type="text" name="venue" id="venue"
                                       @input="inputChange" v-bind:value="venue"
                                       placeholder="Venue" class="form-control" />
                            </div>

                            <div class="col-md-6 form-group text-input-container">
                                <label class="control-label">Area</label>
                                <input type="text" name="area" id="area"
                                       @input="inputChange" v-bind:value="area"
                                       placeholder="Area" class="form-control" />
                            </div>

                            <div class="col-md-6 form-group text-input-container">
                                <label class="control-label">Sub Area</label>
                                <input type="text" name="sub_area" id="sub_area"
                                       @input="inputChange" v-bind:value="sub_area"
                                       placeholder="Sub Area" class="form-control" />
                            </div>

                            <div class="col-md-6 form-group text-input-container">
                                <label class="control-label">Street</label>
                                <input type="text" name="street" id="street"
                                       @input="inputChange" v-bind:value="street"
                                       placeholder="Street" class="form-control" />
                            </div>

                            <div class="col-md-6 form-group text-input-container">
                                <label class="control-label">Rate Minimum</label>
                                <input type="number" name="rate" id="rate"
                                       @input="inputChange" v-bind:value="rate"
                                       placeholder="Rate Minimum" class="form-control" />
                            </div>

                            <div class="col-md-6 form-group text-input-container">
                                <label class="control-label">Rate Max</label>
                                <input type="number" name="rate_max" id="rate_max"
                                       @input="inputChange" v-bind:value="rate_max"
                                       placeholder="Rate Max" class="form-control" />
                            </div>

                            <div class="col-md-6 form-group text-input-container">
                                <label class="control-label">Estimated Foot Traffic</label>
                                <input type="text" name="eft" id="eft"
                                       @input="inputChange" v-bind:value="eft"
                                       placeholder="Estimated Foot Traffic" class="form-control" />
                            </div>

                            <div class="col-md-3 form-group text-input-container">
                                <label class="control-label">EFT Male</label>
                                <input type="number" name="eft_male" id="eft_male"
                                       @input="inputChange" v-bind:value="eft_male"
                                       placeholder="EFT Male" class="form-control" />
                            </div>

                            <div class="col-md-3 form-group text-input-container">
                                <label class="control-label">EFT Female</label>
                                <input type="number" name="eft_female" id="eft_female"
                                       @input="inputChange" v-bind:value="eft_female"
                                       placeholder="EFT Female" class="form-control" />
                            </div>

                            <div class="col-md-6 form-group text-input-container">
                                <label class="control-label">Target Hits</label>
                                <input type="text" name="target_hits" id="target_hits"
                                       @input="inputChange" v-bind:value="target_hits"
                                       placeholder="Target Hits" class="form-control" />
                            </div>

                            <div class="col-md-3 form-group text-input-container">
                                <label class="control-label">Actual Hits Male</label>
                                <input type="number" name="actual_hits" id="actual_hits"
                                       @input="inputChange" v-bind:value="actual_hits"
                                       placeholder="Actual Hits Male" class="form-control" />
                            </div>

                            <div class="col-md-3 form-group text-input-container">
                                <label class="control-label">Actual Hits Female</label>
                                <input type="number" name="actual_hits_f" id="actual_hits_f"
                                       @input="inputChange" v-bind:value="actual_hits_f"
                                       placeholder="Actual Hits Female" class="form-control" />
                            </div>

                            <div class="col-md-3 form-group text-input-container">
                                <label class="control-label">Actual Dry Male</label>
                                <input type="number" name="actual_dry_m" id="actual_dry_m"
                                       @input="inputChange" v-bind:value="actual_dry_m"
                                       placeholder="Actual Dry Male" class="form-control" />
                            </div>

                            <div class="col-md-3 form-group text-input-container">
                                <label class="control-label">Actual Dry Female</label>
                                <input type="number" name="actual_dry_f" id="actual_dry_f"
                                       @input="inputChange" v-bind:value="actual_dry_f"
                                       placeholder="Actual Dry Female" class="form-control" />
                            </div>

                            <div class="col-md-3 form-group text-input-container">
                                <label class="control-label">Actual Exper Male</label>
                                <input type="number" name="actual_exper_m" id="actual_exper_m"
                                       @input="inputChange" v-bind:value="actual_exper_m"
                                       placeholder="Actual Exper Male" class="form-control" />
                            </div>

                            <div class="col-md-3 form-group text-input-container">
                                <label class="control-label">Actual Exper Female</label>
                                <input type="number" name="actual_exper_f" id="actual_exper_f"
                                       @input="inputChange" v-bind:value="actual_exper_f"
                                       placeholder="Actual Exper Female" class="form-control" />
                            </div>

                            <div class="col-md-12 form-group text-input-container">
                                <label class="control-label">LSM</label>
                                <input type="number" name="lsm" id="lsm"
                                       @input="inputChange" v-bind:value="lsm"
                                       placeholder="LSM" class="form-control" />
                            </div>

                            <div class="col-md-4 form-group text-input-container">
                                <label class="control-label">Contact Person</label>
                                <input type="text" name="contact_person" id="contact_person"
                                       @input="inputChange" v-bind:value="contact_person"
                                       placeholder="Contact Person" class="form-control" />
                            </div>

                            <div class="col-md-4 form-group text-input-container">
                                <label class="control-label">Contact Number</label>
                                <input type="text" name="contact_number" id="contact_number"
                                       @input="inputChange" v-bind:value="contact_number"
                                       placeholder="Contact Number" class="form-control" />
                            </div>

                            <div class="col-md-4 form-group text-input-container">
                                <label class="control-label">Contact Email</label>
                                <input type="email" name="contact_email" id="contact_email"
                                       @input="inputChange" v-bind:value="contact_email"
                                       placeholder="Contact Email" class="form-control" />
                            </div>

                            <div class="col-md-12 form-group text-input-container">
                                <label class="control-label">Remarks</label>
                                <input type="text" name="remarks" id="remarks"
                                       @input="inputChange" v-bind:value="remarks"
                                       placeholder="Remarks" class="form-control" />
                            </div>

                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="button" @click="saveProject">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                category: '',
                subcategory: '',
                venue: '',
                area: '',
                street: '',
                sub_area: '',
                rate: '',
                rate_max: '',
                eft: '',
                eft_male: '',
                eft_female: '',
                target_hits: '',
                actual_hits: '',
                actual_hits_f: '',
                actual_dry_m: '',
                actual_dry_f: '',
                actual_exper_m: '',
                actual_exper_f: '',
                lsm: '',
                contact_person: '',
                contact_number: '',
                contact_email: '',
                remarks: '',
            }
        },
        mounted() {
        },
        methods: {
            resetForm() {
                this.category = ''
                this.subcategory = ''
                this.venue = ''
                this.area = ''
                this.street = ''
                this.sub_area = ''
                this.rate = ''
                this.rate_max = ''
                this.eft = ''
                this.eft_male = ''
                this.eft_female = ''
                this.target_hits = ''
                this.actual_hits = ''
                this.actual_hits_f = ''
                this.actual_dry_m = ''
                this.actual_dry_f = ''
                this.actual_exper_m = ''
                this.actual_exper_f = ''
                this.lsm = ''
                this.contact_person = ''
                this.contact_number = ''
                this.contact_email = ''
                this.remarks = ''
            },
            inputChange(e) {
                this[e.target.id] = e.target.value
            },
            saveProject(e) {

                let data = {
                    category: this.category,
                    subcategory: this.subcategory,
                    venue: this.venue,
                    area: this.area,
                    street: this.street,
                    sub_area: this.sub_area,
                    rate: this.rate,
                    rate_max: this.rate_max,
                    eft: this.eft,
                    eft_male: this.eft_male,
                    eft_female: this.eft_female,
                    target_hits: this.target_hits,
                    actual_hits: this.actual_hits,
                    actual_hits_f: this.actual_hits_f,
                    actual_dry_m: this.actual_dry_m,
                    actual_dry_f: this.actual_dry_f,
                    actual_exper_m: this.actual_exper_m,
                    actual_exper_f: this.actual_exper_f,
                    lsm: this.lsm,
                    contact_person: this.contact_person,
                    contact_number: this.contact_number,
                    contact_email: this.contact_email,
                    remarks: this.remarks,
                }

                let url = `/api/v1/venues`;
                this.$http.post(url, data).then(response => {
                    console.log(response)

                    this.$events.fire('reload-table')
                    this.resetForm()
                    $('#createVenue').modal('hide')
                }, error => {
                    console.log(error)
                })
            }
        }
    }
</script>
