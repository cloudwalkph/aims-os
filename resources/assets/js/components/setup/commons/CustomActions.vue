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
                console.log('custom-actions: ' + action, data, index);

                if (action === 'delete-item') {
                    let url = `/api/v1/setup/manpower/${data.id}`;
                    this.$http.delete(url, data).then(response => {
                        toastr.success('Successfully deleted manpower', 'Success')
                        console.log(response)

                        this.$events.fire('reload-table')
                    }, error => {
                        toastr.error('Failed in deleting manpower', 'Error')
                        console.log(error)
                    })
                }

                if(action === 'edit-item')
                {
                    this.$events.fire('edit-table', data);
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