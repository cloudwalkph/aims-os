<template>
    <div class="custom-actions">
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
                    let url = `/api/v1/clients/${data.id}`;
                    this.$http.delete(url, data).then(response => {
                        console.log(response)

                        this.$events.fire('reload-table')
                    }, error => {
                        console.log(error)
                    })
                } else if (action === 'edit-item') {
//                    $('#editClient #company').val(data.company)
//                    $('#editClient #contact_person').val(data.contact_person)
//                    $('#editClient #contact_number').val(data.contact_number)
//                    $('#editClient #email').val(data.email)

                    this.$events.fire('update-client-show', data)
                    $('#editClient').modal('show')
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