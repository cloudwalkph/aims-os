<template>
	<div class="col-md-12">
		<div class="container-fluid" style="padding-top: 10px;padding-bottom: 10px">
			<span>Job Order Number : </span><span><strong>{{data}}</strong></span>
		</div>
		
		<!-- <vuetable ref="vuetable_joManpower"
        			api-url="/api/v1/hr/job-order-manpower/{data}"
        			:fields="fields"
       	></vuetable> -->

       	<table class="table table-striped">
       		<thead>
       			<tr>
       				<td>Manpower</td>
       				<td>Manpower Needed</td>
       				<td>Rate</td>
       			</tr>
       		</thead>
       		<tbody>
       			<tr v-for="man in joManpowerList">
       				<td>{{man.manpower_type.name}}</td>
       				<td>{{man.manpower_needed}}</td>
       				<td>{{man.rate}}</td>
       			</tr>
       		</tbody>
       	</table>

       	<hr style="border-color: #000;margin: 50px 0;" />

       	<vuetable ref="vuetable_manpower"
        			api-url="/api/v1/hr/manpower"
        			:fields="fields"
       	></vuetable>

	</div>
</template>

<script>
	import vuetable from 'vuetable-2/src/components/Vuetable'; 
	import Vue from 'vue';
	import VueEvents from 'vue-events';
	import moment from 'moment';

	Vue.use(VueEvents);

	export default {
		components: {
            vuetable
        },
		mounted() {
			this.getJobOrderManpower();
		},
		data() {
			return {
				fields : [
					{
                        name: '__checkbox',
                        titleClass: 'text-center',
                        dataClass: 'text-center',
                    },
                    {
                        name: 'profile_picture',
                        title: 'Photo',
                        callback: 'imageParse',
                        dataClass : 'customWith10'
                    },
        			{
        				name: 'name',
        				title: 'Full Name',
                        dataClass : 'middleAlign'
        			},
        			{
        				name: 'manpower_type.name',
        				title: 'Manpower Type',
                        dataClass : 'middleAlign'
        			},
        			{
        				name: 'agency.name',
        				title: 'Agency',
                        dataClass : 'middleAlign'
        			},
        			{
        				name: 'birthdate',
        				title: 'Age',
        				callback: 'getAge',
                        dataClass : 'middleAlign'
        			},
        			{
        				name: 'email',
        				title: 'Email',
                        dataClass : 'middleAlign'
        			},
        			{
        				name: 'contact_number',
        				title: 'Contact #',
                        dataClass : 'middleAlign'
        			},
        			{
        				name: 'updated_at',
        				title: 'Last Updated',
        				callback: 'parseDate',
                        dataClass : 'middleAlign'
        			},
					{
						name: '__handle',   // <----
						dataClass: 'center aligned'
					}
        		],
				joManpowerList : []
			}
		},
		props: [ 
			'data'
		],
		computed: {
			apiUrl : () => {

				return '/api/v1/hr/job-order-manpower/'+ $('#jobOrderNumberElement').val();
			}
		},
		methods : {
			getAge(value) {
        		return moment().month(0).from(moment(value).month(0));
        	},
        	parseDate(value) {
        		return moment(value).format('MMM DD YYYY');
        	},
            imageParse(value) {
                if(value)
                    return '<div><img src="/'+value+'" style="width : 50%;"/></div>';
            },
			getJobOrderManpower() {
				let url = '/api/v1/hr/job-order-manpower/' + this.data;
                this.$http.get(url).then(response => {
                    this.joManpowerList = response.data.data;
                    console.log(response.data)
                }, error => {
                    console.log(error)
                });
			}
		},
		events: {
			'vuetable:loading' : function() {
				alert('asd');
				this.$refs.vuetable_joManpower.apiUrl = this.apiUrl;
	        },
			'vuetable:load-success': function(response) {
				alert('end')
	            console.log(this.apiUrl);
	        }
		}
	}
</script>