<template>
    <div class="custom-actions">
        <!--<button class="btn btn-sm" @click="itemAction('view-item', rowData, rowIndex)"><i class="glyphicon glyphicon-zoom-in"></i></button>-->
        <!-- <button class="btn btn-sm" @click="itemAction('edit-item', rowData, rowIndex)"><i class="glyphicon glyphicon-pencil"></i></button> -->
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

                if (action === 'delete-item') {
                    this.$events.fire('remove-selected', data);
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