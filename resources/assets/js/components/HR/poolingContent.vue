<template>
	<div class="col-md-12">
		<div class="container-fluid" style="padding-top: 10px;padding-bottom: 10px">
			<span>Job Order Number : </span><span><strong>{{data}}</strong></span>
		</div>
    <br/>
    <br/>
    <div class="container-fluid">
      <div class="col-md-8 col-md-offset-2">
        <h3>Manpower Pooling</h3>
        <div class="table-responsive" style="max-height: 300px;overflow-y: auto;">
         	<table class="table table-bordered">
         		<thead>
         			<tr>
         				<td>Manpower</td>
         				<td>Manpower Needed</td>
         				<td>Rate</td>
         			</tr>
         		</thead>
         		<tbody v-if="joManpowerList.length > 0">
         			<tr v-for="man in joManpowerList">
         				<td>{{man.manpower_type.name}}</td>
         				<td>{{man.manpower_needed}}</td>
         				<td>{{man.rate}}</td>
         			</tr>
         		</tbody>
            <tbody v-else>
              <tr>
                <td colspan="3" class="text-center">No Data</td>
              </tr>
            </tbody>
         	</table>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
        
    <hr style="border-color: #000;margin: 50px 0;" />

    <div class="container-fluid">
      <div class="col-md-4 col-md-offset-4">
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#plan" aria-controls="plan" role="tab" data-toggle="tab">Plan</a></li>
          <li role="presentation"><a href="#final_deployment" aria-controls="final_deployment" role="tab" data-toggle="tab">Final Deployment</a></li>
        </ul>
      </div>
    </div>
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="plan" style="padding-top: 30px;">
        
        <h3>Manpower</h3>
        <filter-bar></filter-bar>
        <div class="table-responsive" style="height: 300px;overflow-y: auto;">
         	<vuetable ref="vuetable_manpower"
          			:api-url="apiUrl"
          			:fields="fields"
                pagination-path=""
                :multi-sort="true"
                :css="css.table"
                :sort-order="sortOrder"
                detail-row-component="my-detail-row"
                :append-params="moreParams"
                @vuetable:cell-clicked="onCellClicked"
                @vuetable:pagination-data="onPaginationData"
         	></vuetable>
          <div class="vuetable-pagination">
            <vuetable-pagination-info ref="paginationInfo"
                                      info-class="pagination-info"
            ></vuetable-pagination-info>
            <vuetable-pagination ref="pagination"
                                 :css="css.pagination"
                                 :icons="css.icons"
                                 @vuetable-pagination:change-page="onChangePage"
            ></vuetable-pagination>
        </div>
        </div>

        <div class="col-md-8">
          <h3>Selected Manpower</h3>
          <table class="table table-striped">
            <thead>
              <tr>
                <td>Full Name</td>
                <td>Manpower Type</td>
                <td>Assigned Venue</td>
                <td>Action</td>
                <td>&nbsp;</td>
              </tr>
            </thead>
            <tbody>
              <tr v-for="selected in selectedManpower">
                <td>{{selected.first_name + ' ' + selected.middle_name + ' ' + selected.last_name}}</td>
                <td>{{selected.manpower_type.name}}</td>
                <td>
                  <select @change="onAssignVenue($event, selected.id)">
                    <option value=""></option>
                    <option v-for="venue in venueList" :value="venue.id" :selected="venue.id == selected.venue_id">{{venue.venue}}</option>
                  </select>
                </td>
                <td>
                  <button class="btn btn-sm btn-danger" @click="handleRemoveManpower(selected.id)"><i class="glyphicon glyphicon-trash"></i></button>
                </td>
                <td v-if="selected.surpassing" class="text-center" style="background: grey;color: #fff;">
                  Extra
                </td>
              </tr>
            </tbody>
          </table>
          <button class="btn btn-primary pull-right" @click="handleAddManpower">Save</button>
        </div>

        <div class="clearfix"></div>
        <hr style="border-color: #000;margin: 50px 0;" />

        <div class="col-md-12">
          <div class="col-md-2"><h4 class="text-center">Manpower Briefing Schedule:</h4></div>
          <div class="col-md-10">
            
            <div class="row" style="margin-bottom: 20px;" v-for="briefing in briefingSched">
              <div class="col-md-4"><input type="date" class="form-control" disabled :value="briefing.date"/></div>
              <div class="col-md-4"><input type="time" class="form-control" disabled :value="briefing.time"/></div>
              <div class="col-md-3">
                <select class="form-control" disabled>
                  <option v-for="venue in venueList" :value="venue.id" :selected="venue.id == briefing.venue_id">{{venue.venue}}</option>
                </select>
              </div>
              <div class="col-md-1">
                <button class="btn btn-sm btn-danger">
                  <i class="glyphicon glyphicon-trash" @click="deleteManpowerSchedule(briefing.id, 'briefingSched')" style="font-size: 21px;"></i>
                </button>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4"><label class="control-label">Date</label><input type="date" class="form-control" :value="briefingDate" @input="inputChange" id="briefingDate" /></div>
              <div class="col-md-4"><label class="control-label">Time</label><input type="time" class="form-control" :value="briefingTime" @input="inputChange" id="briefingTime" /></div>
              <div class="col-md-3">
                <label class="control-label">Venue</label>
                <select class="form-control" @change="onChangeEvents" id="briefingVenue">
                  <option value=""></option>
                  <option v-for="venue in venueList" :value="venue.id">{{venue.venue}}</option>
                </select>
              </div>
              <div class="col-md-1">
                <button class="btn btn-sm btn-danger" @click="addManpowerSchedule('briefingSched')" style="margin-top: 26px;">
                  <i class="glyphicon glyphicon-plus-sign" style="font-size: 21px;"></i>
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="clearfix"></div>
        <hr style="border-color: #000;margin: 50px 0;" />

        <div class="col-md-12" style="padding-bottom: 30px;">
          <div class="col-md-2"><h4 class="text-center">Manpower Training and Simulation Schedule:</h4></div>
          <div class="col-md-10">
            
            <div class="row" style="margin-bottom: 20px;" v-for="simulation in simulationSched">
              <div class="col-md-2"><input type="text" class="form-control" disabled :value="simulation.batch" /></div>
              <div class="col-md-3"><input type="date" class="form-control" disabled :value="simulation.date" /></div>
              <div class="col-md-3"><input type="time" class="form-control" disabled :value="simulation.time" /></div>
              <div class="col-md-2">
                <select class="form-control" disabled>
                  <option v-for="venue in venueList" :value="venue.id" :selected="venue.id == simulation.venue_id">{{venue.venue}}</option>
                </select>
              </div>
              <div class="col-md-1">
                <button class="btn btn-sm btn-danger">
                  <i class="glyphicon glyphicon-trash" @click="deleteManpowerSchedule(briefing.id, 'simulationSched')" style="font-size: 21px;"></i>
                </button>
              </div>
            </div>

            <div class="row">
              <div class="col-md-2"><label class="control-label">Batch</label><input type="text" class="form-control" :value="batch" @input="inputChange" id="batch" /></div>
              <div class="col-md-3"><label class="control-label">Date</label><input type="date" class="form-control" :value="simulationDate" @input="inputChange" id="simulationDate" /></div>
              <div class="col-md-3"><label class="control-label">Time</label><input type="time" class="form-control" :value="simulationTime" @input="inputChange" id="simulationTime" /></div>
              <div class="col-md-2">
                <label class="control-label">Venue</label>
                <select class="form-control" @change="onChangeEvents" id="simulationVenue">
                  <option value=""></option>
                  <option v-for="venue in venueList" :value="venue.id">{{venue.venue}}</option>
                </select>
              </div>
              <div class="col-md-1">
                <button class="btn btn-sm btn-danger" @click="addManpowerSchedule('simulationSched')" style="margin-top: 26px;">
                  <i class="glyphicon glyphicon-plus-sign" style="font-size: 21px;"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      
      </div>
      <div role="tabpanel" class="tab-pane" id="final_deployment" style="padding-top: 30px;">
        <div class="col-md-12">
            <button class="btn btn-default pull-right" onclick="frames['finalDeploymentFrame'].print()">
                <i class="fa fa-print fa-lg"></i> Print Final deployment
            </button>
        </div>
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-6">
              <h4 class="text-center">Briefing Schedule</h4>
              <div v-for="(briefing, key) in deploymentManpower.briefing">
                <table class="table table-striped">
                  <caption>Team : {{key}}</caption>
                  <thead>
                    <tr>
                      <th>Full Name</th>
                      <th>Manpower Type</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="manpowerList in briefing">
                      <td>{{manpowerList.manpower.first_name + ' ' + manpowerList.manpower.last_name}}</td>
                      <td>{{manpowerList.manpower.manpower_type.name}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-md-6">
              <h4 class="text-center">Training and simulation Schedule</h4>
              <div v-for="(simulation, key) in deploymentManpower.simulation">
                <table class="table table-striped">
                  <caption>Team : {{key}}</caption>
                  <thead>
                    <tr>
                      <th>Full Name</th>
                      <th>Manpower Type</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="manpowerList in simulation">
                      <td>{{manpowerList.manpower.first_name + ' ' + manpowerList.manpower.last_name}}</td>
                      <td>{{manpowerList.manpower.manpower_type.name}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
	</div>
</template>

<script>
	import vuetable from 'vuetable-2/src/components/Vuetable'; 
	import Vue from 'vue';
	import VueEvents from 'vue-events';
  import VuetablePagination from 'vuetable-2/src/components/VuetablePagination'
  import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo'
	import moment from 'moment';
  import CustomAddAction from '../HR/commons/CustomAddAction';
  import FilterBar from '../HR/commons/FilterBar';

	Vue.use(VueEvents);
  Vue.component('CustomAddAction', CustomAddAction);
  Vue.component('filter-bar', FilterBar);

	export default {
		components: {
            vuetable,
            VuetablePagination,
            VuetablePaginationInfo
        },
		mounted() {
			this.getJobOrderManpower();
      this.getSelectedManpower();
      this.getVenues();
      this.getManpowerSchedule();
      this.manpowerDeployment();
		},
		data() {
			return {
        apiUrl: `/api/v1/hr/manpower/${$('#jobOrderNumberElement').val()}`,
				fields : [
              {
                  name: '__sequence',
                  titleClass: '#',
                  titleClass: 'text-right',
                  dataClass: 'text-right'
              },
              {
                  name: 'profile_picture',
                  title: 'Photo',
                  callback: 'imageParse',
                  dataClass : 'customWith10'
              },
        			{
                name: 'first_name',
                sortField: 'first_name',
                title: 'First Name',
                dataClass : 'middleAlign'
              },
              {
        				name: 'last_name',
                sortField: 'last_name',
        				title: 'Last Name',
                dataClass : 'middleAlign'
        			},
        			{
        				name: 'manpower_type.name',
                sortField: 'manpower_type.name',
        				title: 'Manpower Type',
                dataClass : 'middleAlign'
        			},
        			{
        				name: 'agency.name',
                sortField: 'agency.name',
        				title: 'Agency',
                        dataClass : 'middleAlign'
        			},
        			{
        				name: 'birthdate',
                sortField: 'birthdate',
        				title: 'Age',
        				callback: 'getAge',
                        dataClass : 'middleAlign'
        			},
        			{
        				name: 'email',
                sortField: 'email',
        				title: 'Email',
                        dataClass : 'middleAlign'
        			},
        			{
        				name: 'contact_number',
                sortField: 'contact_number',
        				title: 'Contact #',
                        dataClass : 'middleAlign'
        			},
        			{
                name: 'updated_at',
        				sortField: 'updated_at',
        				title: 'Last Updated',
        				callback: 'parseDate',
                        dataClass : 'middleAlign'
        			},
              {
                  name: '__component:CustomAddAction',
                  title: 'Actions',
                  titleClass: 'text-center',
                  dataClass: 'text-center middleAlign'
              },
    					{
                name: '__handle',   // <----
                dataClass: 'center aligned'
              }
        		],
            css: {
              table: {
                tableClass: 'table table-bordered',
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
              },
            },
            sortOrder: [
              { field: 'first_name', sortField: 'first_name', direction: 'DESC'}
            ],
            moreParams: {},
				joManpowerList : [],
        selectedManpower : [],
        venueList : [],
        briefingSched : [],
        simulationSched : [],
        deploymentManpower : [],

        briefingDate : '',
        briefingTime : '',
        briefingVenue: '',

        batch : '',
        simulationDate : '',
        simulationTime : '',
        simulationVenue : ''
			}
		},
		props: [ 
			'data',
      'joId'
		],
		methods : {
      inputChange(e) {
        this[e.target.id] = e.target.value;
      },
      onChangeEvents(e) {
        this[e.target.id] = e.target.value;
      },
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
        }, error => {
            console.log(error)
        });
			},
      getSelectedManpower(joNumber) {
        let url = '/api/v1/hr/selected-manpower/' + this.data;
        this.$http.get(url).then(response => {

          for(let jo in this.joManpowerList) // manpower needed list
          {
            for(let man in response.data) // selected manpower to jo
            {
              let dataList = response.data[man]['manpower'];
              dataList.venue_id = response.data[man]['venue_id'];
              if(this.joManpowerList[jo]['manpower_type_id'] == dataList['manpower_type_id'])
              {
                if(this.joManpowerList[jo]['manpower_needed'] == this.selectedManpower.length)
                {
                  dataList.surpassing = 'Extra';
                  this.selectedManpower = this.selectedManpower.concat([dataList]);
                }else{
                  this.selectedManpower = this.selectedManpower.concat([dataList]);
                }
                
              }
              
            }
          }

        }, error => {
            console.log(error)
        });
      },
      getVenues() {
        let url = '/api/v1/venues/plans/job-order/' + this.joId;
        this.$http.get(url).then(response => {
            this.venueList = response.data;
        }, error => {
            console.log(error)
        });
      },
      handleRemoveManpower(id) {
        let index = this.selectedManpower.findIndex((item) => item.id == id);
        let url = '/api/v1/hr/selected-manpower/' + index;
        

        this.$http.delete(url).then(response => {
          this.selectedManpower.splice(index, 1);
          $('#button-' + id).show();
          
        }, error => {
          console.log(error)
        })
        
      },
      handleAddManpower() {
        let url = '/api/v1/hr/selected-manpower/' + this.data;
        let dataArray = {
          'manpower' : this.selectedManpower
        };
        
        this.$http.post(url, dataArray).then(response => {
          console.log(response.data)
          toastr.success('Successfully saved!', 'Success');
        }, error => {
          console.log(error)
        })

      },
      onAssignVenue(event, manpowerId) {
        let index = this.selectedManpower.findIndex((item) => item.id == manpowerId);
        this.selectedManpower[index].venue_id = event.target.value;

      },
      addManpowerSchedule(type) {
        let data = {
          date: this.briefingDate,
          time: this.briefingTime,
          venue_id: this.briefingVenue,
          type: type
        };

        if(type == 'simulationSched')
        {
          data = {
            date: this.simulationDate,
            time: this.simulationTime,
            venue_id: this.simulationVenue,
            batch: this.batch,
            type: type
          }
        }
        
        let url = '/api/v1/hr/manpower-schedule/' + this.data;
        this.$http.post(url, data).then(response => {
          
          let data = this.parseDateTime(response.data);
          this[type] = this[type].concat([data]);

        }, error => {
          console.log(error)
        });
      },
      parseDateTime(obj) {
        obj.time = moment(obj.created_datetime).format('HH:mm:ss');
        obj.date = moment(obj.created_datetime).format('YYYY-MM-DD');
        return obj;
      },
      getManpowerSchedule() {
        let url = '/api/v1/hr/manpower-schedule/' + this.data;
        this.$http.get(url).then(response => {
          
          for(let res of response.data)
          {
            let data = this.parseDateTime(res);
            
            if(data.type == 'briefingSched')
            {
              this.briefingSched = this.briefingSched.concat([data]);
              
            }else{
              this.simulationSched = this.simulationSched.concat([data]);
              
            }
            
          }
          

        }, error => {
          console.log(error);
        });
      },
      deleteManpowerSchedule(id, type) {
        let url = '/api/v1/hr/manpower-schedule/' + id;
        this.$http.delete(url).then(response => {
          let index = this[type].findIndex((item) => item.id == id);
          this[type].splice(index, 1);
        }, error => {
          console.log(error);
        });
      },
      manpowerDeployment() {
        let url = '/api/v1/hr/manpower-deployment/' + this.data;
        this.$http.get(url).then(response => {
          this.deploymentManpower = response.data;
          // console.log(response.data)
        }, error => {
          console.log(error);
        })
      },

      onCellClicked (data, field, event) {
          console.log('cellClicked: ', field.name)
          this.$refs.vuetable.toggleDetailRow(data.id)
      },

      onPaginationData (paginationData) {
          this.$refs.pagination.setPaginationData(paginationData)
          this.$refs.paginationInfo.setPaginationData(paginationData)
      },
      onChangePage (page) {
          this.$refs.vuetable.changePage(page)
      }
		},
		events: {
        'add-data' (data, index) {
            
            Vue.nextTick( 
                () => {
                  this.selectedManpower = this.selectedManpower.concat([data]);
                    $('#button-' + data.id).hide();
                    this.$refs.vuetable_manpower.refresh();
                }
            )
        },
        'filter-set' (filterText) {
            this.moreParams = {
                filter: filterText
            }
            
            Vue.nextTick( () => this.$refs.vuetable_manpower.refresh() )
        },   
        'filter-reset' () {
            this.moreParams = {}
            Vue.nextTick( () => this.$refs.vuetable_manpower.refresh() )
        }
	  }
  }
</script>