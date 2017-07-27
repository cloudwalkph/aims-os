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
			<div class="col-md-4">
				<div>
					<label>Manpower Needed: {{joOrderDetailData.manpower_needed}}</label><span></span>
				</div>
				<div>
					<label>AE: {{joOrderDetailData.job_order ? joOrderDetailData.job_order.user.profile.first_name + ' ' + joOrderDetailData.job_order.user.profile.last_name : ''}}</label><span></span>
				</div>
			</div>
		</div>
		<div class="container-fluid text-center">
			<h4>Initial Plan</h4>
		</div>
		<div class="container-fluid">
			<ul class="nav nav-tabs" role="tablist">
			    <li role="presentation" class="active"><a href="#currentSetup" aria-controls="currentSetup" role="tab" data-toggle="tab">Manpower Available</a></li>
			    <li role="presentation"><a href="#selectedSetup" aria-controls="selectedSetup" role="tab" data-toggle="tab">Selected Manpower</a></li>
			    <li role="presentation"><a href="#schedulesManpower" aria-controls="schedulesManpower" role="tab" data-toggle="tab">Briefing Schedules</a></li>
			</ul>
		</div>
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="currentSetup">
				<filter-bar></filter-bar>
				<div class="table-responsive" style="max-height: 320px;overflow-y: auto;">
					<vuetable 
						ref="Vuetable_setup_list"
						:api-url="apiMPurl"
						:fields="fields"
						pagination-path=""
						:css="css.table"
						:sort-order="sortOrder"
						:multi-sort="true"
						:append-params="moreParams"
						@vuetable:cell-clicked="onCellClicked"
					></vuetable>
					<div class="vuetable-pagination">
						<vuetable-pagination-info 
							ref="paginationInfo"
							info-class="pagination-info"
						></vuetable-pagination-info>
						<vuetable-pagination 
							ref="pagination"
							:css="css.pagination"
							:icons="css.icons"
						@vuetable-pagination:change-page="onChangePage"
					></vuetable-pagination>
					</div>

				</div>
			</div>
			<div role="tabpanel" class="tab-pane" id="selectedSetup">
				<div class="container-fluid" style="max-height: 320px;overflow-y: auto;">
					<vuetable 
						ref="Vuetable_selected_setup"
						:api-url="apiUrl"
						:fields="selectedFields"
						pagination-path=""
						:css="css.table"
						:sort-order="sortOrder"
						:multi-sort="true"
						@vuetable:cell-clicked="onCellClickedSelected"
					></vuetable>
					<div class="vuetable-pagination">
						<vuetable-pagination-info 
							ref="paginationInfo"
							info-class="pagination-info"
						></vuetable-pagination-info>
						<vuetable-pagination 
							ref="pagination"
							:css="css.pagination"
							:icons="css.icons"
						@vuetable-pagination:change-page="onChangePage"
					></vuetable-pagination>
					</div>
				</div>
			</div>
			<div role="tabpanel" class="tab-pane" id="schedulesManpower">
				<div class="container-fluid">
					<p>Briefing Schedules</p>
					<div class="row" style="margin-bottom: 20px;" v-for="briefing in briefingSched">
		                <div class="col-md-4"><input type="date" class="form-control" disabled
		                                             :value="briefing.date"/></div>
		                <div class="col-md-4"><input type="time" class="form-control" disabled
		                                             :value="briefing.time"/></div>
		                <div class="col-md-3">
		                    <select class="form-control" disabled>
		                        <option v-if="briefing.venue_id == 0" value="">TBA</option>
		                        <option v-else v-for="venue in venueList" :value="venue.id"
		                                :selected="venue.id == briefing.venue_id">{{venue.venue}}
		                        </option>
		                    </select>
		                </div>
		                <div class="col-md-1">
		                    <button class="btn btn-sm btn-danger">
		                        <i class="glyphicon glyphicon-trash"
		                           @click="deleteManpowerSchedule(briefing.id, 'briefingSched')"
		                           style="font-size: 21px;"></i>
		                    </button>
		                </div>
		            </div>
					<div class="row">
		                <div class="col-md-4">
		                	<label class="control-label">Date</label>
		                	<input type="date" class="form-control" :value="briefingDate" @input="inputChange" id="briefingDate"/>
		                </div>
		                <div class="col-md-4">
		                	<label class="control-label">Time</label>
		                	<input type="time" class="form-control" :value="briefingTime" @input="inputChange" id="briefingTime"/>
		                </div>
		                <div class="col-md-3">
		                    <label class="control-label">Venue</label>
		                    <select class="form-control" @change="onChangeEvents" id="briefingVenue">
		                        <option value="">TBA</option>
		                        <option v-for="venue in venueList" :value="venue.id">{{venue.venue}}</option>
		                    </select>
		                </div>
		                <div class="col-md-1">
		                    <button class="btn btn-sm btn-danger" @click="addManpowerSchedule('briefingSched')"
		                            style="margin-top: 26px;">
		                        <i class="glyphicon glyphicon-plus-sign" style="font-size: 21px;"></i>
		                    </button>
		                </div>
		            </div>
				</div>
				<div class="container-fluid" style="margin-bottom: 100px;">
					<div class="col-md-12" style="padding-top: 60px;">
						<button type="button" class="btn btn-default pull-right" @click="goToFinalDeployment">Continue to final deployment</button>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="changeVenueModal" tabIndex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Change Venue</h4>
                    </div>
                    <div class="modal-body">
                    	<select class="form-control" @change="onAssignVenue($event)">
	                        <option value="0">TBA</option>
	                        <option v-for="venue in venueList" :value="venue.id" :selected="venue.id == selectedManpower.venue_id">{{venue.venue}}</option>
	                    </select>
                    </div>
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

    import CustomRemoveSelected from '../setup/commons/CustomRemoveSelected';
    import FilterBar from '../setup/commons/FilterBar';

    Vue.use(VueEvents);
    Vue.component('CustomRemoveSelected',CustomRemoveSelected);
    Vue.component('filter-bar', FilterBar);

	export default {
		components: {
			Vuetable,
			VuetablePagination,
			VuetablePaginationInfo
		},
		mounted() {
			this.getJobOrderManpower();
			this.getManpowerSchedule();
			this.getVenues();
			// let url = `/api/v1/setup/selected/manpower/${$('#jobOrderId').val()}`;
			// this.$http.get(url).then(response => {
			// 	console.log(response.data);			
			// }, error => {
			
			// });
		},
		data() {
			return {
				apiUrl: `/api/v1/setup/selected/manpower/${$('#jobOrderId').val()}`,
				apiMPurl: `/api/v1/setup/manpowerList/${$('#jobOrderId').val()}`,
				fields : [
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
        				name: 'agency.name',
        				title: 'Agency',
                        dataClass : 'middleAlign'
        			},
        			{
                        name: 'birthdate',
                        sortField: 'birthdate',
                        dataClass: 'middleAlign',
                        callback: 'formatDate|DD-MM-YYYY',
                        title: 'Birthdate'
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
                        sortField: 'updated_at',
                        dataClass: 'middleAlign',
                        callback: 'formatDate|DD-MM-YYYY',
                        title: 'Last Updated'
        			}
        		],
        		selectedFields : [
        			{
                        name: 'manpower',
                        title: 'Name',
                        callback: 'getFullName',
                        dataClass : 'customWith10'
                    },
                    {
                        name: 'venue.venue',
                        title: 'Venue',
                        callback: 'parseVenue',
                        dataClass : 'customWith10'
                    },
                    {
                        name: 'buffer',
                        title: 'Buffer',
                        dataClass : 'customWith10',
                        callback: 'bufferParse'
                    },
                    {
                        name: '__component:CustomRemoveSelected',
                        title: 'Actions',
                        titleClass: 'text-center',
                        dataClass: 'customWith10'
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
               	moreParams: {},

               	briefingDate: '',
                briefingTime: '',
                briefingVenue: '',

                briefingSched: [],
                venueList: [],
                jobOrderNumberLabel: $('#jobOrderNumber').val(),
                jobOrderTitleLabel: $('#jobOrderTitle').val(),
                joOrderDetailData: {},
                selectedManpower: {}
			}
		},
		methods: {
			getVenues() {
                let url = `/api/v1/venues/plans/job-order/${$('#jobOrderId').val()}`;
                this.$http.get(url).then(response => {
                    this.venueList = response.data;
                    console.log(response.data)
                }, error => {
                    console.log(error)
                });
            },
			getManpowerSchedule() {
                let url = `/api/v1/hr/manpower-schedule/${$('#jobOrderNumber').val()}`;
                this.$http.get(url).then(response => {
                    // console.log(response.data)
                    for (let res of response.data) {
                        let data = this.parseDateTime(res);

                        if (data.type == 'briefingSched') {
                            this.briefingSched = this.briefingSched.concat([data]);

                        }

                    }


                }, error => {
                    console.log(error);
                });
            },
			deleteManpowerSchedule(id, type) {
                let url = `/api/v1/hr/manpower-schedule/${id}`;
                this.$http.delete(url).then(response => {
                    let index = this[type].findIndex((item) => item.id == id);
                    this[type].splice(index, 1);
                }, error => {
                    console.log(error);
                });
            },
			addManpowerSchedule(type) {
                let data = {
                    date: this.briefingDate,
                    time: this.briefingTime,
                    venue_id: this.briefingVenue,
                    type: type
                };
                // alert('asd');return;
                let url = `/api/v1/hr/manpower-schedule/${$('#jobOrderNumber').val()}`;
                this.$http.post(url, data).then(response => {

                    let data = this.parseDateTime(response.data);
                    this[type] = this[type].concat([data]);

                }, error => {
                    console.log(error)
                });
            },
			onChangeEvents(e) {
                this[e.target.id] = e.target.value;
            },
			inputChange(e) {
                this[e.target.id] = e.target.value;
            },
			parseVenue(value) {
				if(value){
					return value
				}
				return 'TBA';
			},
			bufferParse(value) {
				if(value){
					return 'Buffer';
				}
				return '';
			},
			getFullName(value) {
				return `${value.first_name} ${value.last_name}`;
			},
			expandType(value) {
                let arr = [];
                for(let v in value)
                {
                    arr.push(value[v]['manpower_type'].name);
                }
                return arr.toString();
            },
            formatDate (value, fmt = 'D MMM YYYY') {
                return (value == null)
                    ? ''
                    : moment(value, 'YYYY-MM-DD').format(fmt)
            },
        	parseDate(value) {
        		return moment(value).format('MMM DD YYYY');
        	},
            imageParse(value) {
                if(value)
                    return '<div><img src="/'+value+'" style="width : 50%;"/></div>';
            },
            onChangePage (page) {
                this.$refs.Vuetable_setup_list.changePage(page)
            },
			onCellClicked(data, field, event) {

				let url = `/api/v1/setup/selected/manpower/${$('#jobOrderId').val()}`;
				this.$http.post(url,data).then(response => {
					
					this.$refs.Vuetable_selected_setup.refresh();		
					this.$refs.Vuetable_setup_list.refresh();		
					toastr.success(data.first_name + ' Added to selected setup', 'Success');
				}, error => {
				
				});
				// window.location.href = window.location.origin + '/setup/pooling/view/' + data.job_order.id;
			},
			onCellClickedSelected(data, field, event) {
				this.selectedManpower = data;
				$('#changeVenueModal').modal('show')
			},
			onAssignVenue(event, manpowerId) {
                this.selectedManpower.venue_id = event.target.value;
                let url = `/api/v1/setup/change/venue/${this.selectedManpower.id}`;
                console.log(this.selectedManpower);
               	this.$http.post(url,this.selectedManpower).then(response => {
					console.log(response.data)
					this.$refs.Vuetable_selected_setup.reload();		
					$('#changeVenueModal').modal('hide');
				}, error => {
				
				});

            },
			goToFinalDeployment() {
				window.location.href = `${window.location.origin}/setup/final/view/${$('#jobOrderId').val()}`;
			},
			getJobOrderManpower() {
				let joId = $('#jobOrderId').val();
              	let url = `/api/v1/setup/joOrder/${joId}`;
              	this.$http.get(url).then(response => {
              		// console.log(response.data);
              		this.joOrderDetailData = response.data;
                }, error => {
                    console.log(error);
                });
			},
			parseDateTime(obj) {
                obj.time = moment(obj.created_datetime).format('HH:mm:ss');
                obj.date = moment(obj.created_datetime).format('YYYY-MM-DD');
                return obj;
            }
		},
		events: {
			'remove-selected' (data) {
				
				let url = `/api/v1/hr/selected-manpower/${data.manpower.id}/${$('#jobOrderId').val()}`; // params selected id and joborder id
                
                this.$http.delete(url).then(response => {
                    this.$refs.Vuetable_selected_setup.refresh();	
                    this.$refs.Vuetable_setup_list.refresh();	

                }, error => {
                    console.log(error)
                })

			},
			'filter-set' (filterText) {

                this.moreParams = {
                    filter: filterText
                }

                Vue.nextTick(() => this.$refs.Vuetable_setup_list.refresh())
            },
            'filter-reset' () {
                this.moreParams = {}
                Vue.nextTick(() => this.$refs.Vuetable_setup_list.refresh())
            }
		}
	}
</script>