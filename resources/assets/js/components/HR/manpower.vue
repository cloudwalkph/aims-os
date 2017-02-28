<template>
    <div>
        <button class="btn btn-primary pull-right"
                data-toggle="modal" data-target="#createManpower" style="margin-bottom: 20px">
                <i class="fa fa-plus"></i> Add Manpower
        </button>
        <vuetable ref="Vuetable_manpower"
        			api-url="/api/v1/hr/manpower"
        			:fields="fields"
                    :append-params="dataVueTable"
       	></vuetable>

        <div class="modal fade" id="createManpower" tabIndex="-1" role="dialog" aria-labelledby="myModalLabel"> 
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Form</h4>
                    </div>
                    <div class="modal-body">
                        <form id="scheduleForm" @submit.prevent="onSubmitForm">
                            <div class="row">
                                <div class="col-md-12 form-group text-input-container">
                                    <label class="control-label">Profile Picture</label>
                                    <input type="file" name="profile_picture"
                                           id="profile_picture"
                                           class="form-control" />
                                </div>
                                <div class="col-md-12 form-group text-input-container">
                                    <label class="control-label">First Name</label>
                                    <input type="text" name="first_name"
                                           id="first_name"
                                           placeholder="Enter first name" class="form-control" />
                                </div>
                                <div class="col-md-12 form-group text-input-container">
                                    <label class="control-label">Middle Name</label>
                                    <input type="text" name="middle_name"
                                           id="middle_name"
                                           placeholder="Enter middle name" class="form-control" />
                                </div>
                                <div class="col-md-12 form-group text-input-container">
                                    <label class="control-label">Last Name</label>
                                    <input type="text" name="last_name"
                                           id="last_name"
                                           placeholder="Enter last name" class="form-control" />
                                </div>
                                <div class="col-md-12 form-group text-input-container">
                                    <label class="control-label">Manpower Type</label>
                                    <select type="date" name="manpower_type_id"
                                           id="manpower_type_id"
                                           placeholder="Select..." class="form-control">
                                           <option>1</option>
                                    </select>
                                </div>
                                <div class="col-md-12 form-group text-input-container">
                                    <label class="control-label">Agency</label>
                                    <select type="date" name="agency_id"
                                           id="agency_id"
                                           placeholder="Select..." class="form-control">
                                           <option>1</option>
                                    </select>
                                </div>
                                <div class="col-md-12 form-group text-input-container">
                                    <label class="control-label">Birth Date</label>
                                    <input type="date" name="birthdate"
                                           id="birthdate"
                                           class="form-control" />
                                </div>
                                <div class="col-md-12 form-group text-input-container">
                                    <label class="control-label">City</label>
                                    <input type="city" name="city"
                                           id="last_name"
                                           placeholder="Enter City" class="form-control" />
                                </div>
                                <div class="col-md-12 form-group text-input-container">
                                    <label class="control-label">Email Address</label>
                                    <input type="email" name="email"
                                           id="last_email"
                                           placeholder="Enter Email Address" class="form-control" />
                                </div>
                                <div class="col-md-12 form-group text-input-container">
                                    <label class="control-label">Contact Number</label>
                                    <input type="text" name="contact_number"
                                           id="contact_number"
                                           placeholder="Enter contact number" class="form-control" />
                                </div>
                                <div class="col-md-12 form-group text-input-container">
                                    <label class="control-label">Facebook Profile Link</label>
                                    <input type="text" name="fb_link"
                                           id="fb_link"
                                           placeholder="Facebook Link" class="form-control" />
                                </div>
                                <div class="col-md-12 form-group text-input-container">
                                    <label class="control-label">Date Hired</label>
                                    <input type="date" name="hired_date"
                                           id="hired_date"
                                           class="form-control" />
                                </div>
                                <div class="col-md-12 form-group text-input-container">
                                    <label class="control-label">Violations</label>
                                    <input type="text" name="violations"
                                           id="violations"
                                           placeholder="Enter violations" class="form-control" />
                                </div>
                                <div class="col-md-12 form-group text-input-container">
                                    <label class="control-label">Documents</label>
                                    <input type="file" name="documents"
                                           id="documents"
                                           class="form-control" multiple/>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" form="scheduleForm" v-bind:class="[isFetching.disabled ? 'btn btn-primary disabled' : 'btn btn-primary']">{{ isFetching.saveLabel }}</button>
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
    import CustomActions from '../HR/commons/CustomActions';
    import VueEvents from 'vue-events'

    Vue.use(VueEvents);
    Vue.component('CustomActions', CustomActions);

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
        				name: 'name',
        				title: 'Full Name'
        			},
        			{
        				name: 'manpower_type.name',
        				title: 'Manpower Type'
        			},
        			{
        				name: 'agency.name',
        				title: 'Agency'
        			},
        			{
        				name: 'birthdate',
        				title: 'Age',
        				callback: 'getAge'
        			},
        			{
        				name: 'email',
        				title: 'Email'
        			},
        			{
        				name: 'contact_number',
        				title: 'Contact #'
        			},
        			{
        				name: 'updated_at',
        				title: 'Last Updated',
        				callback: 'parseDate'
        			},
					{
						name: '__handle',   // <----
						dataClass: 'center aligned'
					},
					{
                        name: '__component:CustomActions',
                        title: 'Actions',
                        titleClass: 'text-center',
                        dataClass: 'text-center'
                    }
        		],
                isFetching : {
                    disabled : false,
                    saveLabel : 'Save'
                },
                dataVueTable : {}
        	}
        },
        methods: {
        	getAge(value) {
        		return moment().month(0).from(moment(value).month(0));
        	},
        	parseDate(value) {
        		return moment(value).format('MMM DD YYYY');
        	},
            onSubmitForm(e) {
                this.isFetching = {
                    disabled: true,
                    saveLabel: 'Saving...'
                }
                
                let form = new FormData($(e.target)[0]);

                let url = '/api/v1/hr/manpower';
                this.$http.post(url,form).then(response => {
                    console.log(response);
                    this.dataVueTable = {'persist': true,'birthdate' : 'sample'};
                    this.isFetching = {
                        disabled: false,
                        saveLabel: 'Save'
                    };
                    
                    $('#createManpower').modal('hide');
                    this.$refs.Vuetable_manpower.refresh(); // refresh vuetable
                }, error => {
                    console.log(error)
                    this.isFetching = {
                        disabled: false,
                        saveLabel: 'Save'
                    }
                });
                
            }
        },
        events: {
            'filter-set' (filterText) {
                this.moreParams = {
                    filter: filterText
                }
                Vue.nextTick( () => this.$refs.Vuetable_manpower.refresh() )
            },
            'reload-table' () {
                Vue.nextTick( () => this.$refs.Vuetable_manpower.reload() )
            },
            'filter-reset' () {
                this.moreParams = {}
                Vue.nextTick( () => this.$refs.Vuetable_manpower.refresh() )
            }
        }
    }
</script>