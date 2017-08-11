<template>

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">{{jo.job_order.project_name}} | {{jo.job_order.job_order_no}} </h4>
                </div>
                <div class="modal-body">
                    <div>Deadline: {{convertDate(jo.deadline)}}</div>
                    <div class="deliverables">
                        <h5><strong>Deliverables</strong></h5>
                        {{jo.deliverables}}
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary" :href="jobOrderUrl()">View Details</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    module.exports = {
        methods: {
            convertDate: function (dateVal) {
                var milliseconds = Date.parse(dateVal);
                var d = new Date(milliseconds);
                return d.toDateString();
            },
            jobOrderUrl: function() {
                return `/job-orders/${jo.job_order.job_order_no}`;
            }
        },
        mounted: function () {
        },
        props: [
            'jo'
        ]
    }

</script>