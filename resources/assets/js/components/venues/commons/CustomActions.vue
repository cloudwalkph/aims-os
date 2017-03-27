<template>
    <div class="custom-actions">
        <!--<button class="btn btn-sm" @click="itemAction('view-item', rowData, rowIndex)"><i class="glyphicon glyphicon-zoom-in"></i></button>-->
        <button class="btn btn-sm" @click="itemAction('edit-item', rowData, rowIndex)"><i class="glyphicon glyphicon-pencil"></i></button>
        <button class="btn btn-sm btn-danger" @click="itemAction('delete-item', rowData, rowIndex)"><i class="glyphicon glyphicon-trash"></i></button>
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
        methods: {
            itemAction (action, data, index) {
                console.log('custom-actions: ' + action, data.id, index)

                if (action === 'delete-item') {
                    let url = `/api/v1/venues/${data.id}`;
                    this.$http.delete(url, data).then(response => {
                        console.log(response)

                        toastr.success('Successfully deleted venue', 'Success')
                        this.$events.fire('reload-table')
                    }, error => {
                        toastr.error('Failed in deleting venue', 'Error')
                        console.log(error)
                    })
                } else if (action === 'edit-item') {
                    this.$events.fire('update-venues-show', data)
                    $('#editVenues').modal('show')
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