<template>
    <div class="row">

        <div class="col-md-6 form-group text-input-container">
            <label class="control-label col-sm-12">Manpower Type</label>
            <div class="col-md-12">
                <v-select :on-change="typeSelected" :options="manpowerOptions"></v-select>
            </div>
        </div>

        <div class="col-md-3 form-group text-input-container">
            <label class="control-label col-sm-12"># Manpower Needed</label>
            <div class="col-md-12">
                <input type="number" name="manpower_needed"
                       @input="inputChange" v-bind:value="manpower_needed" id="manpower_needed"
                       placeholder="# Manpower" class="form-control" />
            </div>
        </div>

        <div class="col-md-3 form-group text-input-container">
            <label class="control-label col-sm-12">Rate</label>
            <div class="col-md-12">
                <input type="number" name="rate"
                       @input="inputChange" v-bind:value="rate" id="rate"
                       placeholder="Rate" class="form-control" />
            </div>
        </div>

        <div class="col-md-12 form-group text-input-container">
            <label class="control-label col-sm-12">Remarks</label>
            <div class="col-md-12">
                <input type="text" name="remarks"
                       @input="inputChange" v-bind:value="remarks" id="remarks"
                       placeholder="Remarks" class="form-control" />
            </div>
        </div>

        <div class="col-md-12 form-group select-input-container">
            <div class="col-md-4 pull-right">
                <button type="submit" class="btn btn-primary btn-add btn-block" @click="saveProject">Add </button>
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
                manpower_types: [],
                manpowerOptions: [],
                manpower_type_id: '',
                manpower_needed: '',
                rate: '',
                remarks: ''
            }
        },
        mounted() {
            this.getManpowerTypes()
        },
        methods: {
            resetForm() {
                this.job_order_id = ''
                this.manpower_needed = ''
                this.rate = ''
                this.remarks = ''
            },
            inputChange(e) {
                this[e.target.id] = e.target.value
            },
            typeSelected(val) {
                this.manpower_type_id = val.value
            },
            getManpowerTypes() {
                this.$http.get('/api/v1/manpower-types/all').then(response => {
                    let manpower_types = response.data;

                    for (let manpower_type of manpower_types) {
                        this.manpowerOptions.push({label: `${manpower_type.name}`, value: manpower_type.id});
                    }
                }, error => {
                        console.log(error)
                });
            },
            saveProject(e) {
                let jobOrderId = $('#jobOrderId').val();
                let data = {
                    job_order_id: jobOrderId,
                    manpower_type_id: this.manpower_type_id,
                    manpower_needed: this.manpower_needed,
                    rate: this.rate,
                    remarks: this.remarks
                }

                let url = `/api/v1/job-order-manpowers`;
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
