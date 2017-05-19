<template>
    <div class="row">

        <div class="col-md-4 form-group text-input-container">
            <label class="control-label col-sm-12" for="department_id">Departments <span class="required-field">*</span></label>
            <div class="col-md-12">
                <v-select :on-change="departmentSelected" :options="departmentOptions"></v-select>
            </div>
        </div>

        <div class="col-md-4 form-group text-input-container">
            <label class="control-label col-sm-12" for="deadline">Deadline <span class="required-field">*</span></label>
            <div class="col-md-12">
                <input type="text" name="deadline" required placeholder="Deadline"
                       id="deadline" class="form-control"
                       @input="inputChange" v-bind:value="deadline"/>
            </div>
        </div>

        <div class="col-md-4 form-group text-input-container">
            <label class="control-label col-sm-12" for="department_file">File <span class="required-field">*</span></label>
            <div class="col-md-12">
                <input type="file" name="department_file" required placeholder="Input file"
                       id="department_file" class="form-control"
                       @input="inputChange" v-bind:value="department_file"/>
            </div>
        </div>

        <div class="col-md-12 form-group text-area-container">
            <div class="col-md-12">
                <textarea class="form-control" name="deliverables"
                          placeholder="Enter Deliverables" id="deliverables"
                          @input="inputChange" v-bind:value="deliverables"></textarea>
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
                departments: [],
                departmentOptions: [],
                department_id: '',
                department_file: '',
                deadline: moment().format("YYYY-MM-DD HH:mm"),
                deliverables: '',
                job_order_id: ''
            }
        },
        mounted() {
            this.getDepartments();

            $('#deadline').on('dp.change', (newDate, oldDate) => {
                this.deadline = newDate.date.format("YYYY-MM-DD hh:mm a");
            });
        },
        methods: {
            resetForm() {
                this.deadline = ''
                this.deliverables = ''
                this.department_file = ''
            },
            inputChange(e) {
                this[e.target.id] = e.target.value
            },
            departmentSelected(val) {
                this.department_id = val.value
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
                    deadline: moment(this.deadline, "YYYY-MM-DD hh:mm a").format("YYYY-MM-DD HH:mm:ss"),
                    department_file: this.department_file,
                    deliverables: this.deliverables,
                    department_id: this.department_id
                }

                let url = `/api/v1/job-order-department-involvements`;
                this.$http.post(url, data).then(response => {

                    $('#joFrame').attr('src','/ae/jo/details/'+jobOrderId+'/preview'); 
                    this.$events.fire('reload-table')
                    this.resetForm()
                    toastr.success('Successfully added department involvement', 'Success')
                }, error => {
                    toastr.error('Failed in adding department involvement', 'Error')
                    console.log(error)
                })
                
            }
        }
    }
</script>
