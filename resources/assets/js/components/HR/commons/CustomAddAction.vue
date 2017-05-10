<template>
    <div class="custom-actions">
        <button class="btn btn-sm" title="Add Manpower" v-bind="{id: 'button-' + rowData.id}" @click="itemAction('add-item', rowData, rowIndex)"><i class="glyphicon glyphicon glyphicon-check"></i></button>
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
                console.log(data);
                console.log('custom-actions: ' + action, data, index);

                if(action === 'add-item')
                {
                    this.$events.fire('add-data', data);
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