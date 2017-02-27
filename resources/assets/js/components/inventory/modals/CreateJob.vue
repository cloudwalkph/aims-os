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

                    <form>
                        <div class="row">
                            <div class="col-md-12 form-group text-input-container">
                                <label class="control-label">Job Order Number</label>
                                <select id="job_order_id" name="job_order_id">
                                    <option></option>
                                </select>
                            </div>
                            <div class="col-md-12 form-group text-input-container">
                                <label class="control-label">Description</label>
                                <input type="text" name="description"
                                        @input="inputChange" v-bind:value="event_datetime" id="description"
                                        placeholder="Description" class="form-control" />
                            </div>
                            <div class="col-md-12 form-group text-input-container">
                                <label class="control-label">Deadline</label>
                                <input type="datetime" name="deadline"
                                        @input="inputChange" v-bind:value="event_datetime" id="deadline"
                                        placeholder="Deadline" class="form-control" />
                            </div>
                            <div class="col-md-12 form-group text-input-container">
                                <label class="control-label">Users</label>
                                <select id="user_id" name="user_id">
                                    <option value="" v-for="user in users"></option>
                                </select>
                            </div>

                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="handleClick">Save</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    window.$
</script>