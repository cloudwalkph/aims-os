<template>

    <div class="modal fade" id="modalCreateJob" tabIndex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Creatives Job</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
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
                                <input type="text" name="description" @input="inputChange" id="description" placeholder="Description" class="form-control" />
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
        computed: {
            joOptions: function () {
                var joOptions = [];
                for (let jo of this.propData.jobOrders) {
                    joOptions.push({label: `${jo.job_order_no} : ${jo.project_name}`, value: jo.id});
                }
                return joOptions;
            },
            userOptions: function () {
                var userOptions = [];
                for (let user of this.propData.users) {
                    userOptions.push({label: `${user.profile.first_name} ${user.profile.last_name}`, value: user.id});
                }
                return userOptions;
            }
        },
        data: function () {
            return {
                selected_job_order: null,
                selected_user: null
            }
        },
        methods: {
            handleSubmit: function (e) {
                var form = $(e.target)[0];
                console.log(form);
                // if(d.getHours() == 0) {
                //     d.setHours(8);
                // }
                var created_job_id = this.propData.jobOrders.length + 1;

                this.propData.jobs.push(
                    {
                        id: created_job_id,
                        job_order_id: this.selected_job_order,
                        description: form.description.value,
                        deadline: form.deadline.value
                    }
                );
                this.propData.assignedPeople.push(
                    {
                        inventory_job_id: created_job_id,
                        user_id: this.selected_user
                    }
                )
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
        props: ['propData']
    }

</script>