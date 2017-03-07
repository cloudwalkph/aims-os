<template>
	<div class="col-md-12">
		<div class="container-fluid" style="padding-top: 10px;padding-bottom: 10px">
			<span>Job Order Number : </span><span><strong>{{data}}</strong></span>
		</div>
		
        <div class="col-md-8 col-md-offset-2">
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
        </div>

        <div class="clearfix"></div>
        
        <hr style="border-color: #000;margin: 50px 0;" />
        
        <h3>Manpower</h3>
       	<vuetable ref="vuetable_manpower"
        			api-url="/api/v1/hr/manpower"
        			:fields="fields"
              :multi-sort="true"
       	></vuetable>

        <div class="col-md-8">
          <h3>Selected Manpower</h3>
          <table class="table table-striped">
            <thead>
              <tr>
                <td>Full Name</td>
                <td>Manpower Type</td>
                <td>Assigned Venue</td>
                <td>Action</td>
              </tr>
            </thead>
            <tbody>
              <tr v-for="selected in selectedManpower">
                <td>{{selected.first_name + ' ' + selected.middle_name + ' ' + selected.last_name}}</td>
                <td>{{selected.manpower_type.name}}</td>
                <td>
                  <select @change="onAssignVenue($event, selected.id)">
                    <option value=""></option>
                    <option v-for="venue in venueList" :value="venue.id">{{venue.venue}}</option>
                  </select>
                </td>
                <td>
                  <button class="btn btn-sm btn-danger" @click="handleRemoveManpower(selected.id)"><i class="glyphicon glyphicon-trash"></i></button>
                </td>
              </tr>
            </tbody>
          </table>
          <button class="btn btn-primary pull-right" @click="handleAddManpower">Save</button>
        </div>

        <div class="clearfix"></div>
        <hr style="border-color: #000;margin: 50px 0;" />



	</div>
</template>

<script>
	import vuetable from 'vuetable-2/src/components/Vuetable'; 
	import Vue from 'vue';
	import VueEvents from 'vue-events';
	import moment from 'moment';
  import CustomAddAction from '../HR/commons/CustomAddAction';

	Vue.use(VueEvents);
  Vue.component('CustomAddAction', CustomAddAction);

	export default {
		components: {
            vuetable
        },
		mounted() {
			this.getJobOrderManpower();
      this.getSelectedManpower();
      this.getVenues();
		},
		data() {
			return {
				fields : [
					    {
                  name: '__checkbox:id',
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
				joManpowerList : [],
        selectedManpower : [],
        venueList : []
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
        }, error => {
            console.log(error)
        });
			},
      getSelectedManpower(joNumber) {
        let url = '/api/v1/hr/selected-manpower/' + this.data;
        this.$http.get(url).then(response => {
          for(let man in response.data)
          {
            this.selectedManpower = this.selectedManpower.concat([response.data[man]['manpower']]);
          }
        }, error => {
            console.log(error)
        });
      },
      getVenues() {
        let url = '/api/v1/venues/all';
        this.$http.get(url).then(response => {
            this.venueList = response.data;
        }, error => {
            console.log(error)
        });
      },
      handleRemoveManpower(id) {
        let index = this.selectedManpower.findIndex((item) => item.id == id);
        console.log(index);
        this.selectedManpower.splice(index, 1);
        $('#button-' + id).show();
      },
      handleAddManpower() {
        let url = '/api/v1/hr/selected-manpower/' + this.data;
        let dataArray = {
          'manpower' : this.selectedManpower
        };
        
        this.$http.post(url, dataArray).then(response => {
          console.log(response.data)
        }, error => {
          console.log(error)
        })

      },
      onAssignVenue(event, manpowerId) {
        let index = this.selectedManpower.findIndex((item) => item.id == manpowerId);
        this.selectedManpower[index].venue_id = event.target.value;

      }
		},
		events: {
        'add-data' (data, index) {
            
            Vue.nextTick( 
                () => {
                  this.selectedManpower = this.selectedManpower.concat([data]);
                    $('#button-' + data.id).hide();
                }
            )
        }   
	  }
  }
</script>