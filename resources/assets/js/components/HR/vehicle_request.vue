<template>
	<div class="col-md-12">
		<vuetable 	ref="vehicle_request_list"
					:fields="fields">
		</vuetable>
	</div>
</template>

<script>
	import Vuetable from 'vuetable-2/src/components/Vuetable'; 

	export default {
		components: {
            Vuetable
        },
        data() {
        	return {
        		fields : [
        			{
                        name: 'job_order_no',
                        title: 'Job Order Number'
                    }
        		]
        	}
        }
	}
</script>