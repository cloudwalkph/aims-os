<template>
    <div class="modal fade" id="createAnimationDetails" tabIndex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
        <form @submit.prevent="validateBeforeSubmit">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Animation Details</h4>
                </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 form-group text-input-container" :class="{'has-error': errors.has('particular') }">
                                <label class="control-label" for="particular">Particulars <span class="required-field">*</span></label>
                                <input type="text" name="particular" required id="particular"
                                       @input="inputChange" v-bind:value="particular" v-model="particular" v-validate="'required'" 
                                       placeholder="Particulars" class="form-control" />
                                <span v-show="errors.has('particular')" class="help-block"><strong>{{ errors.first('particular') }}</strong></span>
                            </div>

                            <div class="col-md-12 form-group text-input-container" :class="{'has-error': errors.has('target_activity') }">
                                <label class="control-label" for="target_activity">Target Activity <span class="required-field">*</span></label>
                                <input type="text" name="target_activity" required id="target_activity"
                                       @input="inputChange" v-bind:value="target_activity" v-model="target_activity" v-validate="'required'" 
                                       placeholder="Target Activity" class="form-control" />
                                <span v-show="errors.has('target_activity')" class="help-block"><strong>{{ errors.first('target_activity') }}</strong></span>
                            </div>

                            <div class="col-md-12 text-center">
                                <h4>Target Hits</h4>
                            </div>

                            <div class="col-md-4 form-group text-input-container">
                                <label class="control-label" for="target_selling">Selling</label>
                                <input type="number" name="target_selling" required id="target_selling"
                                       @input="inputChange" v-bind:value="target_selling"
                                       placeholder="Selling" class="form-control" />
                            </div>

                            <div class="col-md-4 form-group text-input-container">
                                <label class="control-label" for="target_flyering">Flyering</label>
                                <input type="number" name="target_flyering" required id="target_flyering"
                                       @input="inputChange" v-bind:value="target_flyering"
                                       placeholder="Flyering" class="form-control" />
                            </div>

                            <div class="col-md-4 form-group text-input-container">
                                <label class="control-label" for="target_survey">Survey</label>
                                <input type="number" name="target_survey" required id="target_survey"
                                       @input="inputChange" v-bind:value="target_survey"
                                       placeholder="Survey" class="form-control" />
                            </div>

                            <div class="col-md-4 form-group text-input-container">
                                <label class="control-label" for="target_experiment">Experiential</label>
                                <input type="number" name="target_experiment" required id="target_experiment"
                                       @input="inputChange" v-bind:value="target_experiment"
                                       placeholder="Experiential" class="form-control" />
                            </div>

                            <div class="col-md-4 form-group text-input-container">
                                <label class="control-label" for="target_experiment">Sampling</label>
                                <input type="number" name="target_sampling" required id="target_sampling"
                                       @input="inputChange" v-bind:value="target_sampling"
                                       placeholder="Sampling" class="form-control" />
                            </div>

                            <div class="col-md-4 form-group text-input-container">
                                <label class="control-label" for="target_others">Others</label>
                                <input type="number" name="target_others" required id="target_others"
                                       @input="inputChange" v-bind:value="target_others"
                                       placeholder="Others" class="form-control" />
                            </div>

                            <div class="col-md-12">
                                <hr/>
                            </div>

                            <div class="col-md-12 form-group text-input-container" :class="{'has-error': errors.has('target_duration') }">
                                <label class="control-label" for="target_duration">Target Duration <span class="required-field">*</span></label>
                                <input type="number" name="target_duration" required id="target_duration"
                                       @input="inputChange" v-bind:value="target_duration" v-model="target_duration" v-validate="'required'" 
                                       placeholder="Target Duration" class="form-control" />
                                <span v-show="errors.has('target_duration')" class="help-block"><strong>{{ errors.first('target_duration') }}</strong></span>
                            </div>

                            <div class="col-md-12 form-group text-input-container" :class="{'has-error': errors.has('target_areas') }">
                                <label class="control-label" for="target_areas">Areas <span class="required-field">*</span></label>
                                <input type="number" name="target_areas" required id="target_areas"
                                       @input="inputChange" v-bind:value="target_areas" v-model="target_areas" v-validate="'required'" 
                                       placeholder="Areas" class="form-control" />
                                <span v-show="errors.has('target_areas')" class="help-block"><strong>{{ errors.first('target_areas') }}</strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import vSelect from 'vue-select'

    Vue.component('v-select', vSelect)
    export default {
        data() {
            return {
                departments: [],
                particular: '',
                target_activity: '',
                target_selling: 0,
                target_flyering: 0,
                target_survey: 0,
                target_experiment: 0,
                target_sampling: 0,
                target_others: 0,
                target_duration: '',
                target_areas: ''
            }
        },
        mounted() {

        },
        methods: {
            validateBeforeSubmit(e) {
                this.$validator.validateAll();
                if (!this.errors.any()) {
                    this.saveProject()
                }
            },
            resetForm() {
                this.particular = ''
                this.target_activity = ''
                this.target_selling = 0
                this.target_flyering = 0
                this.target_survey = 0
                this.target_experiment = 0
                this.target_sampling= 0
                this.target_others = 0
                this.target_duration = ''
                this.target_areas = ''
            },
            inputChange(e) {
                this[e.target.id] = e.target.value
            },
            getDepartments() {
                this.$http.get('/api/v1/departments').then(response => {
                    let departments = response.data;

                    for (let department of departments) {
                        this.departmentOptions.push({label: `${department.name}`, value: department.id});
                    }
                }, error => {
                        console.log(error)
                });
            },
            saveProject(e) {
                let jobOrderId = $('#jobOrderId').val();
                let data = {
                    job_order_id: jobOrderId,
                    particular: this.particular,
                    target_activity: this.target_activity,
                    target_selling: this.target_selling,
                    target_flyering: this.target_flyering,
                    target_survey: this.target_survey,
                    target_experiment: this.target_experiment,
                    target_others: this.target_others,
                    target_sampling: this.target_sampling,
                    target_duration: this.target_duration,
                    target_areas: this.target_areas
                }

                let url = `/api/v1/job-order-animation-details`;
                this.$http.post(url, data).then(response => {

                    $('#joFrame').attr('src','/ae/jo/details/'+jobOrderId+'/preview'); 
                    this.$events.fire('reload-table')
                    this.resetForm()
                    toastr.success('Successfully added animation details', 'Success')
                    $('#createAnimationDetails').modal('hide')
                }, error => {
                    toastr.success('Failed in adding animation details', 'Error')
                    console.log(error)
                })
            }
        }
    }
</script>
