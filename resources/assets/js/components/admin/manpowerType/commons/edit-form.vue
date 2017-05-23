<template>
    <div class="modal fade" id="editTypeModal" tabIndex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Update Manpower Type</h4>
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
                            <div class="col-md-12 form-group text-input-container">
                                <label class="control-label">Rate</label>
                                <input type="text" name="rate"
                                       @input="inputChange" v-bind:value="rate" id="rate"
                                       placeholder="Rate" class="form-control" />
                            </div>
                            <div class="col-md-12 form-group text-input-container">
                                <label class="control-label">Extended Rate</label>
                                <input type="text" name="extended_rate"
                                       @input="inputChange" v-bind:value="extended_rate" id="extended_rate"
                                       placeholder="Extended Rate" class="form-control" />
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="saveManpowerType">Save</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                manpowerTypeId: '',
                name: '',
                rate: '',
                extended_rate: '',
            }
        },
        methods: {
            populateData(data) {
                this.name = data.name
                this.rate = data.rate
                this.extended_rate = data.extended_rate
                this.manpowerTypeId = data.id
            },
            resetForm() {
                this.name = ''
                this.rate = ''
                this.extended_rate = ''
                this.manpowerTypeId = ''
            },
            inputChange(e) {
                this[e.target.id] = e.target.value
            },
            saveManpowerType(e) {

                let data = {
                    name: this.name,
                    rate: this.rate,
                    extended_rate: this.extended_rate,
                }

                let url = `/api/v1/manpower-types/${this.manpowerTypeId}`;
                this.$http.put(url, data).then(response => {
                    console.log(response)

                    toastr.success('Successfully edited manpower type', 'Success')
                    this.$events.fire('reload-table')
                    $('#editTypeModal').modal('hide')
                }, error => {
                    toastr.error('Failed in editing manpower type', 'Error')
                    console.log(error)
                })
            }
        }
    }
</script>
