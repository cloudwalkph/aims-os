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

	export default {
		components: {
            Vuetable
        },
		mounted() {
			this.getJoborder();
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
                    }
        		]

        	}
        },
        methods: {
        	getJoborder() {
        		let url = '/api/v1/hr/poolingManpower/';
                this.$http.get(url).then(response => {
                    console.log(response);
                }, error => {
                    console.log(error);
                });
        	},
        	expandType(value) {
        		console.log(value);
        	}
        }
	}
</script>