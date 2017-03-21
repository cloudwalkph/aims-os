<template>
    <div class="modal fade" id="typeModal" tabIndex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add New Vehicle Type</h4>
                </div>
                <div class="modal-body">
                    <form id="clientForm">

                        <div class="row">
                            <div class="col-md-12 form-group text-input-container">
                                <label class="control-label">Name</label>
                                <input type="text" name="name"
                                       @input="inputChange" v-bind:value="name" id="name"
                                       placeholder="Name" class="form-control" />
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
    export default {
        data() {
            return {
                name: '',
            }
        },
        mounted() {
        },
        methods: {
            resetForm() {
                this.name = ''
            },
            inputChange(e) {
                this[e.target.id] = e.target.value
            },
            saveProject(e) {

                let data = {
                    name: this.name,
                }

                let url = `/api/v1/vehicle-types`;
                this.$http.post(url, data).then(response => {
                    console.log(response)

                    toastr.success('Successfully added new vehicle type', 'Success')
                    this.$events.fire('reload-table')
                    this.resetForm()
                    $('#typeModal').modal('hide')
                }, error => {
                    toastr.error('Failed in adding new vehicle type', 'Error')
                    console.log(error)
                })
            }
        }
    }
</script>
