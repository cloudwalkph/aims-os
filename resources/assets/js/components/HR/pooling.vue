<template>
	<div class="col-md-12">
		<vuetable ref="vuetable_pooling"
        			api-url="/api/v1/hr/poolingManpower/"
        			:fields="fields"
       	></vuetable>
	</div>
</template>

<script>
	import Vuetable from 'vuetable-2/src/components/Vuetable'; 
	import Vue from 'vue';
	import CustomSingleAction from '../HR/commons/CustomSingleAction';

	import VueEvents from 'vue-events';

    Vue.use(VueEvents);
    Vue.component('CustomSingleAction', CustomSingleAction);

	export default {
		components: {
            Vuetable
        },
		mounted() {
			
		},
		data() {
        	return {
        		fields : [
                    {
                        name: 'job_order_no',
                        title: 'Job Order Number'
                    },
                    {
                        name: 'project_name',
                        title: 'Project Name'
                    },
                    {
                    	name: 'jo_manpower',
                    	title: 'Manpower Type',
                    	callback : 'expandType'
                    },
                    {
                        name: '__component:CustomSingleAction',
                        title: 'Actions',
                        titleClass: 'text-center',
                        dataClass: 'text-center middleAlign'
                    }
        		]

        	}
        },
        methods: {
        	expandType(value) {
        		let arr = [];
        		for(let v in value)
        		{
        			arr.push(value[v]['manpower_type'].name);
        		}
        		return arr.toString();
        	}
        },
        events: {
        	'view-data' (data) {

        		Vue.nextTick(
        			() => {
        				window.location.href = window.location.origin + '/hr/manpower_pooling/view/' + data.job_order_no; 
        			}
        		)
        	}
        }
	}
</script>