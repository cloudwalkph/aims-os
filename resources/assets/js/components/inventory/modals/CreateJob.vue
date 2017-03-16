<template>

    <div class="modal fade" id="modalCreateJob" tabIndex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Add Inventory Job</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger hide">
                        This is an alert message
                    </div>

                    <form id="createJobForm" @submit.prevent="handleSubmit">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="job_order_id">Job Order Number</label>
                                <v-select :on-change="joSelected" :options="joOptions"></v-select>
                            </div>
                            <div class="col-md-12 form-group text-input-container">
                                <label class="control-label">Description</label>
                                <input type="text" name="description" @input="inputChange" id="description" placeholder="Description" class="form-control"
                                />
                            </div>
                            <div class="col-md-12 form-group text-input-container">
                                <label class="control-label">Deadline</label>
                                <input type="date" name="deadline" @input="inputChange" id="deadline" placeholder="Deadline" class="form-control" />
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="user_id">Users</label>
                                <v-select :on-change="userSelected" :options="userOptions"></v-select>
                            </div>

                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" form="createJobForm" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    module.exports = {
        data: function () {
            return {
                joOptions: [],
                userOptions: [],
                selected_job_order: null,
                selected_user: null,
            }
        },
        methods: {
            getJo: function () {
                var joData = [];
                this.$http.get('/api/v1/inventory/job/create')
                    .then(function (response) {
                        for (let jo of response.data) {
                            this.joOptions.push({
                                label: `${jo.job_order_no} : ${jo.project_name}`,
                                value: jo.id
                            });
                        }
                    })
                    .catch(function (e) {
                        console.log('error department', e);
                    });
            },
            getUser: function () {
                var userOptions = [];
                this.$http.get('/api/v1/inventory/user/create')
                    .then(function (response) {
                        for (let user of response.data) {
                            this.userOptions.push(
                                {
                                    label: `${user.profile.first_name} ${user.profile.last_name}`,
                                    value: user.id
                                }
                            );
                        }
                    })
                    .catch(function (e) {
                        console.log('error users', e);
                    });
            },
            convertDate: function (dateString) {
                var milliseconds = Date.parse(dateString);
                var d = new Date(milliseconds);
                return d;
            },
            handleSubmit: function (e) {
                var form = $(e.target)[0];
                // if(d.getHours() == 0) {
                //     d.setHours(8);
                // }
                var created_job_id = this.propData.jobOrders.length + 1;

                var postData = {
                    job_order_id: this.selected_job_order,
                    description: form.description.value,
                    deadline: this.convertDate(form.deadline.value),
                    user_id: this.selected_user
                }

                this.$http.post('/api/v1/inventory/job', postData)
                    .then(function (response) {
                        this.propData.inventoryJobs.push(
                            {
                                id: created_job_id,
                                job_order_id: this.selected_job_order,
                                description: form.description.value,
                                deadline: form.deadline.value,
                                user_id: [this.selected_user],
                            }
                        );
                        $('#modalCreateJob').modal('hide');
                    })
                    .catch(function (e) {
                        console.log(e);
                    });

            },
            inputChange: function (e) {

            },
            joSelected: function (e) {
                this.selected_job_order = e.value;
            },
            userSelected: function (e) {
                this.selected_user = e.value;
            }
        },
        mounted: function () {
            this.getJo();
            this.getUser();
        },
        props: ['propData']
    }

</script>