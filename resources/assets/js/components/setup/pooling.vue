<template>
	<div>
		<vuetable 
			ref="Vuetable_joList"
			api-url="/api/v1/setup/joOrder/list"
			:fields="fields"
			pagination-path=""
			:css="css.table"
			:sort-order="sortOrder"
			:multi-sort="true"
			:append-params="moreParams"
			@vuetable:cell-clicked="onCellClicked"
		></vuetable>
	</div>
</template>

<script>
	import moment from 'moment'
	import Vuetable from 'vuetable-2/src/components/Vuetable'; 
	import Vue from 'vue';
	import VueEvents from 'vue-events';
	import VuetablePagination from 'vuetable-2/src/components/VuetablePagination';
    import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo';

	Vue.use(VueEvents);

	export default {
		components: {
			Vuetable,
			VuetablePagination,
			VuetablePaginationInfo
		},
		mounted() {
			// let url = '/api/v1/setup/joOrder/list';
			// this.$http.get(url).then(response => {
			// 	console.log(response);			
			// }, error => {
			
			// });
		},
		data() {
			return {
				fields : [
	                {
	                    name: 'job_order.job_order_no',
	                    title: 'Job order number',
	                    dataClass : 'customWith10'
	                },
	                {
	                    name: 'job_order.project_name',
	                    title: 'Project Name',
	                    dataClass : 'customWith10'
	                },
	                {
	                	name: 'manpower_needed',
	                	title: '# of Setup',
	                	dataClass : 'customWith10'
	                },
	                {
	                	name: 'remarks',
	                	title: 'Remarks',
	                	dataClass : 'customWith10'
	                },
	                {
	                	name: 'status',
	                	title: 'Status',
	                	dataClass : 'customWith10'
	                }
	            ],
	            css: {
                    table: {
                        tableClass: 'table table-bordered table-striped table-hover',
                        ascendingIcon: 'glyphicon glyphicon-chevron-up',
                        descendingIcon: 'glyphicon glyphicon-chevron-down'
                    },
                    pagination: {
                        wrapperClass: 'pagination',
                        activeClass: 'active',
                        disabledClass: 'disabled',
                        pageClass: 'page',
                        linkClass: 'link',
                    },
                    icons: {
                        first: 'glyphicon glyphicon-step-backward',
                        prev: 'glyphicon glyphicon-chevron-left',
                        next: 'glyphicon glyphicon-chevron-right',
                        last: 'glyphicon glyphicon-step-forward',
                    }
               	},
               	sortOrder: [
                    { field: 'created_at', sortField: 'created_at', direction: 'asc'}
               	],
               	moreParams: {}
			}
		},
		methods: {
			parseManpowerNeeded(value) {
				let needed = 0;
				for(let v of value)
				{
					needed = v.manpower_needed
				}
				return needed;
			},
			parseRemarks(value) {
				let needed = 0;
				for(let v of value)
				{
					needed = v.remarks
				}
				return needed;
			},
			parseStatus(value) {
				let needed = 0;
				for(let v of value)
				{
					needed = v.status
				}
				return needed;
			},
			onCellClicked(data, field, event) {
			
				window.location.href = window.location.origin + '/setup/pooling/view/' + data.job_order.id;
			}
		}
	}
</script>