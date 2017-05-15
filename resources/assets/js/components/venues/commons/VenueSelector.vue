<template>
    <div class="custom-actions">
        <input type="checkbox" :value="rowData.id" v-model="selectedVenueIds"  @click="itemAction('select-item', rowData, rowIndex)" />
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
                selectedVenueIds: []
            }
        },
        methods: {
            itemAction (action, data, index) {
                if (action === 'select-item') {
                    this.$events.fire('selected-venue', data);
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