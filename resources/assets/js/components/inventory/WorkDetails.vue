<template>

    <div class="row">
        <div class="col-sm-12">
            <div class="col-md-8">
                <label htmlFor="joNumber" class="control-label">Job Order Number : {{joborder.jonumber}}</label>
            </div>
            <div class="col-md-4 text-right">
                <label htmlFor="assigned" class="control-label">Assigned Persons : {{joborder.assignedperson}}</label>
            </div>
            <div class="col-md-8">
                <label htmlFor="projectName" class="control-label">Project Name : {{joborder.projectname}}</label>
            </div>
            <div class="col-md-4 text-right">
                <label htmlFor="description" class="control-label">Description : {{joborder.description}}</label>
            </div>
        </div>

        <div class="col-sm-12">
            <delivery-tracking :deliveries="deliveries"></delivery-tracking>
        </div>

        <div class="col-sm-12">
            <hr/>
        </div>

        <div class="col-sm-12">
            <release-tracking :releases="releases"></release-tracking>
        </div>
    </div>

</template>

<script>
    var DeliveryTracking = require('./DeliveryTracking.vue');
    var ReleaseTracking = require('./ReleaseTracking.vue');

    module.exports = {
        data: function() {
            return {
                joborder: 
                    {
                        jonumber: 20001345268,
                        assignedperson: 'Alleo Indong',
                        projectname: 'Ponds Activations',
                        description: 'Description Here',
                    }
                ,
                deliveries: [
                    {
                        date: 'Dec. 22, 2016',
                        delivered: '100000',
                        balance: '900000',
                    },
                    {
                        date: 'Dec. 23, 2016',
                        delivered: '100000',
                        balance: '800000',
                    },
                    {
                        date: 'Dec. 24, 2016',
                        delivered: '100000',
                        balance: '700000',
                    },
                ],
                releases: [
                    {
                        date: 'Dec. 23, 2016',
                        productsOnHand: '100000',
                        disposed: '50000',
                        returned: '0',
                        status: 'Approved',
                    },
                    {
                        date: 'Dec. 24, 2016',
                        productsOnHand: '150000',
                        disposed: '',
                        returned: '',
                        status: 'Pending',
                    },
                ]
            }
        },
        components: {
            DeliveryTracking,
            ReleaseTracking
        }
    }
</script>