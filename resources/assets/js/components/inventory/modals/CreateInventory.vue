<template>

    <div class="modal fade" id="createIventory" tabIndex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Create Inventory</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-md-12 form-group text-input-container">
                                <label class="control-label">Id</label>
                                <input type="text" name="job_order_id"
                                        @input="inputChange" v-bind:value="event_datetime" id="joInventory"
                                        placeholder="Job Order id" class="form-control" />
                            </div>
                            <div class="col-md-12 form-group text-input-container">
                                <label class="control-label">Title</label>
                                <input type="text" name="name"
                                        @input="inputChange" v-bind:value="event_datetime" id="titleInventory"
                                        placeholder="Title" class="form-control" />
                            </div>
                            <div class="col-md-12 form-group text-input-container">
                                <label class="control-label">Expiration Date</label>
                                <input type="date" name="name"
                                        @input="inputChange" v-bind:value="event_datetime" id="date_expiration"
                                        placeholder="Expiration Date" class="form-control" />
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
    module.exports = {
        data: function() {
            return {
                event_datetime: '',

            }
        },
        methods: {
            inputChange: function() {

            },
            handleClick: function() {
                alert('form submitted');
            }
        }
    }
</script>