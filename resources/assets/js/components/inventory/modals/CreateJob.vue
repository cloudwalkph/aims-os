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
                                <select class="form-control" id="job_order_id" name="job_order_id">
                                    <option 
                                        v-for="jobOrder in propData.projects" 
                                        :value="jobOrder.projectID"
                                    >
                                        {{jobOrder.projectName}}
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-12 form-group text-input-container">
                                <label class="control-label">Description</label>
                                <input type="text" name="description"
                                        @input="inputChange" id="description"
                                        placeholder="Description" class="form-control" />
                            </div>
                            <div class="col-md-12 form-group text-input-container">
                                <label class="control-label">Deadline</label>
                                <input type="date" name="deadline"
                                        @input="inputChange" id="deadline"
                                        placeholder="Deadline" class="form-control" />
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="user_id">Users</label>
                                <select class="form-control" id="user_id" name="user_id">
                                    <option v-for="user in propData.users" :value="user.id">{{user.label}}</option>
                                </select>
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
        data: function() {
            return {
                event_datetime: ''
            }
        },
        methods: {
            inputChange: function() {

            },
            handleClick: function() {
                
            },
            handleSubmit: function(e) {
                var form = $(e.target)[0];
                var d = Date.parse(form.deadline.value);
                var d = new Date(d);
                // if(d.getHours() == 0) {
                //     d.setHours(8);
                // }
                created_job_id = this.propData.jobOrders.length + 1;

                this.propData.jobOrders.push(
                    {
                        jobOrderID: created_job_id,
                        projectID: form.projectID.value,
                        description: form.description.value,
                        deadline: d.getHours(),
                        assignedPerson: form.user_id.value
                    }
                );
            }
        },
        props: ['propData']
    }
</script>