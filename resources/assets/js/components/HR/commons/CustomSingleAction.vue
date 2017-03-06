<template>
    <div class="custom-actions">
        <button class="btn btn-sm" @click="itemAction('view-item', rowData, rowIndex)"><i class="glyphicon glyphicon-zoom-in"></i></button>
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

                if(action === 'view-item')
                {
                    this.$events.fire('view-data', data);
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