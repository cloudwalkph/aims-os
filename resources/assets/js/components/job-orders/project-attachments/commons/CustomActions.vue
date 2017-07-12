<template>
    <div class="custom-actions">
        <!--<button class="btn btn-sm" @click="itemAction('view-item', rowData, rowIndex)"><i class="glyphicon glyphicon-zoom-in"></i></button>-->
        <!--<button class="btn btn-sm" @click="itemAction('edit-item', rowData, rowIndex)"><i class="glyphicon glyphicon-pencil"></i></button>-->
        <button class="btn btn-sm btn-danger" @click="itemAction('delete-item', rowData, rowIndex)"><i class="glyphicon glyphicon-trash"></i></button>
        <a class="btn btn-sm btn-default" :href="href"><i class="fa fa-download"></i></a>
    </div>
</template>

<script>
    export default {
        props: {
            rowData: {
                type: Object,
                required: true
            },
            rowIndex: {
                type: Number
            }
        },
        data() {
            return {
                href: `/api/v1/job-order-project-attachments/${this.rowData.id}/download?api_token=${window.token}`
            }
        },
        methods: {
           itemAction (action, data, index) {
               console.log('custom-actions: ' + action, data.id, index)

               if (action === 'delete-item') {
                    let url = `/api/v1/job-order-project-attachments/${data.id}`;
                    this.$http.delete(url, data).then(response => {
                        console.log(response)

                        toastr.success('Successfully deleted project attachments', 'Success')
                        this.$events.fire('reload-table')
                    }, error => {
                        toastr.success('Failed in deleting project attachments', 'Error')
                        console.log(error)
                    })
                }

           }
        }
    }
</script>

<style>
    .custom-actions button.ui.button {
        padding: 8px 8px;
    }
    .custom-actions button.ui.button > i.icon {
        margin: auto !important;
    }
</style>