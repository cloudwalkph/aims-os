<template>
    <div class="custom-actions">
        <!--<button class="btn btn-sm" @click="itemAction('view-item', rowData, rowIndex)"><i class="glyphicon glyphicon-zoom-in"></i></button>-->
        <!--<button class="btn btn-sm" @click="itemAction('edit-item', rowData, rowIndex)"><i class="glyphicon glyphicon-pencil"></i></button>-->
        <!--<button class="btn btn-sm btn-danger" @click="itemAction('delete-item', rowData, rowIndex)"><i class="glyphicon glyphicon-trash"></i></button>-->
        <a class="btn btn-sm btn-default" ><i class="fa fa-print"></i></a>
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
                
            }
        },
        methods: {
//            itemAction (action, data, index) {
//                console.log('custom-actions: ' + action, data.id, index)
//
//                if (action === 'download-item') {
//                    let url = `/api/v1/job-order-project-attachments/${data.id}/download`;
//                    window.open(url, "_blank");
////                    this.$http.get(url, data).then(response => {
////                        console.log(response)
////
////                        this.$events.fire('reload-table')
////                    }, error => {
////                        console.log(error)
////                    })
//                }
//
//            }
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