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
                                <input
                                  type="text"
                                  name="description"
                                  @input="inputChange"
                                  id="description"
                                  placeholder="Description"
                                  class="form-control"
                                />
                            </div>
                            <div class="col-md-12 form-group text-input-container">
                                <label class="control-label">Deadline</label>
                                <input
                                  type="text"
                                  name="deadline"
                                  @input="inputChange"
                                  id="deadline"
                                  placeholder="Deadline"
                                  class="form-control"
                                />
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="user_id">Users</label>
                                <v-select :on-change="userSelected" multiple :options="userOptions"></v-select>
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
                selected_users: null,
            }
        },
        methods: {
            getJo: function () {
                this.$http.get('api/v1/inventory/job/create')
                    .then(function (response) {
                        for (let jo of response.data) {
                            if(jo) {
                                this.joOptions.push({
                                    label: `${jo.job_order_no} : ${jo.project_name}`,
                                    value: jo.id
                                });
                            }
                        }
                    })
                    .catch(function (e) {
                        console.log('error jobs filter', e);
                    });
            },
            getUser: function () {
                this.$http.get('api/v1/inventory/user/create')
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
                        console.log('error users filter', e);
                    });
            },
            convertDate: function (dateVal) {
                var milliseconds = Date.parse(dateVal);
                var d = new Date(milliseconds);
                return d.toDateString();
            },
            handleSubmit: function (e) {
                var form = $(e.target)[0];
                // if(d.getHours() == 0) {
                //     d.setHours(8);
                // }

                var postData = {
                    job_order: this.selected_job_order,
                    users: this.selected_users,
                    department_id: 5,
                    deadline: form.deadline.value,
                    description: form.description.value,
                }

                this.$http.post('api/v1/inventory/job', postData)
                    .then(function (response) {
                        $('#modalCreateJob').modal('hide');
                        form.reset();
                        this.refreshVuetable();
                    })
                    .catch(function (e) {
                        console.log('error post jobs', e);
                    });
            },
            inputChange: function (e) {

            },
            joSelected: function (val) {
                this.selected_job_order = JSON.stringify(val);
            },
            userSelected: function (val) {
                this.selected_users = JSON.stringify(val);
            }
        },
        mounted: function () {
            this.getJo();
            this.getUser();

            $('#deadline').datetimepicker();
            $('#deadline').on('dp.change', (newDate, oldDate) => {
                this.deadline = newDate.date.format("YYYY-MM-DD hh:mm a");
            });
        },
        props: {
          propData: Object,
          refreshVuetable: Function,
        }
    }

</script>
