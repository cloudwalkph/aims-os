<template>
    <div class="custom-actions">
        <button class="btn btn-sm" @click="itemAction('view-item', rowData, rowIndex)"><i class="glyphicon glyphicon-zoom-in"></i> View</button>
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
                if (action === 'view-item') {
                    if($('#departmentId').val() == 1) {
                        location.href = `/productions/jo/details/${data.job_order_no}`;
                    }else if($('#departmentId').val() == 2) {
                        location.href = `/creatives/work-in-progress/${data.id}/preview`;
                    }else if($('#departmentId').val() == 3) {
                        location.href = `/cmtuva/plans/${data.job_order_no}`;
                    }
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
