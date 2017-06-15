<template>
    <div class="custom-actions">
        <button class="btn btn-sm btn-success" @click="itemAction('accept-item', rowData, rowIndex)"><i class="fa fa-check"></i></button>
        <button class="btn btn-sm btn-danger" @click="itemAction('reject-item', rowData, rowIndex)"><i class="fa fa-remove"></i></button>
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
