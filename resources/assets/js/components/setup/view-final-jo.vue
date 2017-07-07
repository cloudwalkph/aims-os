<template>
	<div>
		<div class="container-fluid">
			<div class="col-md-4">
				<div>
					<label>Job Order #: {{jobOrderNumberLabel}}</label><span></span>
				</div>
				<div>
					<label>Project Title: {{jobOrderTitleLabel}}</label><span></span>
				</div>
			</div>
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<button type="button" class="btn btn-default btn-block" onclick="frames['finalDeploymentFrameSetup'].print();">Print</button>
			</div>
		</div>
		<div class="container-fluid">
			<h4 class="text-center">Final Deployment</h4>
            <div v-for="(briefing, key) in deploymentManpower.briefing">
				<div class="col-md-12">
					<h4>TEAM : {{key}}</h4>
				</div>
				<div class="col-md-12 col-sm-12" v-for="manpowerSched in briefing">
					<table class="table table-striped">
						<caption>DATE : {{manpowerSched.created_datetime}}</caption>
						<thead>
							<tr>
							    <th>Full Name</th>
							    <th>Buffer</th>
							</tr>
						</thead>
						<tbody>
						<tr v-for="manpowerList in manpowerSched.manpower_list">
						    <td>
						    	{{manpowerList.manpower.first_name + ' ' + manpowerList.manpower.last_name}}
						    </td>
						    <td v-if="manpowerList.buffer == 1">Buffer</td>
						    <td v-else></td>
						</tr>
						</tbody>
					</table>
				</div>
            </div>
		</div>
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
			this.manpowerDeployment();
		},
		data() {
			return {
				deploymentManpower: [],
				jobOrderNumberLabel: $('#jobOrderNumber').val(),
                jobOrderTitleLabel: $('#jobOrderTitle').val() 
			}
		},
		methods: {
			manpowerDeployment() {
                let url = `/api/v1/hr/manpower-deployment/${$('#jobOrderNumber').val()}`;
                this.$http.get(url).then(response => {
                    this.deploymentManpower = response.data;
                    // console.log(response.data);                                                                                              
                }, error => {
                    console.log(error);
                })
            }
		}
    }

</script>