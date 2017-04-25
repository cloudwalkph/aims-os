<template>
    <div class="modal fade" id="createProjectAttachments" tabIndex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Project Attachments</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 form-group text-input-container">
                            <label class="control-label" for="reference_for">Reference For</label>
                            <input type="text" name="reference_for" required id="reference_for"
                                       @input="inputChange" v-bind:value="reference_for"
                                       placeholder="Reference" class="form-control" />
                        </div>

                        <div class="col-md-12 form-group text-input-container">
                            <label class="control-label" for="file_name">Project attachment</label>
                            <input type="file" @change="onFileChange">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" @click="saveProject">Add</button>
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
                referenceOptions: [],
                file: '',
                reference_for: '',
            }
        },
        mounted() {
        
        },
        methods: {
            resetForm() {
                this.reference_for = ""
            },
            inputChange(e) {
                this[e.target.id] = e.target.value
            },
            onFileChange(e) {
                var files = e.target.files || e.dataTransfer.files;
                console.log(files[0]);
                this.file = files[0];
            },
            saveProject(e) {
                let jobOrderId = $('#jobOrderId').val();

                let form = new FormData();
                form.append('job_order_id', jobOrderId);
                form.append('file', this.file);
                form.append('reference_for', this.reference_for);

                let url = `/api/v1/job-order-project-attachments`;
                this.$http.post(url, form).then(response => {

                    toastr.success('Successfully added project attachments', 'Success')
                    this.$events.fire('reload-table')
                    this.resetForm()
                    $('#createProjectAttachments').modal('hide')
                }, error => {
                    toastr.error('Failed in adding project attachments', 'Error')
                    console.log(error)
                })
            }
        }
    }
</script>
