<template>
    <div class="modal fade" id="ongoingModal" tabIndex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Creatives to JO</h4>
                </div>
                <div class="modal-body">
                    <form id="clientForm">
                        <div class="row">
                            <div class="col-md-12 form-group text-input-container">
                                <label class="control-label">Job Order Number</label>
                                <v-select :on-change="joSelected" :options="joOptions"></v-select>
                            </div>
                            <div class="col-md-12 form-group text-input-container">
                                <label class="control-label">Description</label>
                                <input type="text" name="description"
                                       @input="inputChange" v-bind:value="description" id="description"
                                       placeholder="Description" class="form-control" />
                            </div>
                            <div class="col-md-12 form-group text-input-container">
                                <label class="control-label">Deadline</label>
                                <input type="text" name="deadline"
                                       @input="inputChange" v-bind:value="deadline" id="deadline"
                                       placeholder="Deadline" class="form-control" />
                            </div>
                            <div class="col-md-12 form-group text-input-container">
                                <label class="control-label">Users</label>
                                <v-select :on-change="userSelected" :options="userOptions"></v-select>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="saveProject">Save</button>
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
                users: [],
                job_orders: [],
                userOptions: [],
                joOptions: [],
                job_order_id: '',
                description: '',
                deadline: moment().format("YYYY-MM-DD HH:mm"),
                user_id: ''
            }
        },
        mounted() {
            this.getUsers()
            this.getJobOrders()

            $('#deadline').on('dp.change', (newDate, oldDate) => {
                this.deadline = newDate.date.format("YYYY-MM-DD hh:mm a");
            });
        },
        methods: {
            resetForm() {
                this.job_order_id = ''
                this.description = ''
                this.deadline = ''
                this.user_id = ''
            },
            inputChange(e) {
                this[e.target.id] = e.target.value
            },
            joSelected(val) {
                this.job_order_id = val.value
            },
            userSelected(val) {
                this.user_id = val.value
            },
            getUsers() {
                // the department id of creatives == 2
                this.$http.get('/api/v1/users/2').then(response => {
                    this.users = response.data;
                for (let user of this.users) {
                    this.userOptions.push({label: `${user.profile.first_name} ${user.profile.last_name}`, value: user.id});
                }
            }, error => {
                    console.log(error)
                });
            },
            getJobOrders() {
                this.$http.get('/api/v1/job-orders/department').then(response => {
                    this.job_orders = response.data;

                for (let jo of this.job_orders) {
                    this.joOptions.push({label: `${jo.job_order_no} : ${jo.project_name}`, value: jo.id});
                }
            }, error => {
                    console.log(error)
                });
            },
            saveProject(e) {

                let data = {
                    job_order_id: this.job_order_id,
                    description: this.description,
                    deadline: moment(this.deadline, "YYYY-MM-DD hh:mm a").format("YYYY-MM-DD HH:mm:ss"),
                    user_id: this.user_id
                }

                let url = `/api/v1/creatives`;
                this.$http.post(url, data).then(response => {
                    console.log(response)

                    toastr.success('Successfully assigned user to JO', 'Success')
                    this.$events.fire('reload-table')
                    this.resetForm()
                    $('#ongoingModal').modal('hide')
                }, error => {
                    toastr.error('Failed in assigning user to JO', 'Error')
                    console.log(error)
                })
            }
        }
    }
</script>
