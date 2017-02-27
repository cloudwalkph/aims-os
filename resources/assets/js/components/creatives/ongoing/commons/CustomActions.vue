<template>
    <div class="custom-actions">
        <button class="btn btn-sm" @click="itemAction('view-item', rowData, rowIndex)"><i class="glyphicon glyphicon-zoom-in"></i></button>
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
                    let url = `/api/v1/creatives/${data.id}`;
                    this.$http.delete(url, data).then(response => {
                        console.log(response)

                        this.$events.fire('reload-table')
                    }, error => {
                        console.log(error)
                    })
                }

                if (action === 'view-item') {
                    // /creatives/work-in-progress/{creatives_job_id}/{job_order_id}
                    location.href = `/creatives/work-in-progress/${data.id}/${data.job_order_id}`;
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