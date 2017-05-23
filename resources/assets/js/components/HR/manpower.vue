<template>
    <div>
        <button class="btn btn-primary pull-right"
                data-toggle="modal" data-target="#createManpower" style="margin-bottom: 20px">
                <i class="fa fa-plus"></i> Add Manpower
        </button>
        <vuetable ref="Vuetable_manpower"
        			api-url="/api/v1/hr/manpower"
        			:fields="fields"
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
                                <div class="col-md-4 form-group text-input-container">
                                    <label class="control-label">Profile Picture</label>
                                    <input type="file" name="profile_picture"
                                           id="profile_picture"
                                           class="form-control" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group text-input-container">
                                    <label class="control-label">First Name</label><span>*</span>
                                    <input type="text" name="first_name"
                                            v-model="rowData.first_name"
                                           id="first_name"
                                           required
                                           placeholder="Enter first name" class="form-control" 
                                           v-bind:value="rowData.first_name" />
                                </div>
                                <div class="col-md-4 form-group text-input-container">
                                    <label class="control-label">Middle Name</label>
                                    <input type="text" name="middle_name"
                                            v-model="rowData.middle_name"
                                           id="middle_name"
                                           placeholder="Enter middle name" class="form-control" 
                                           v-bind:value="rowData.middle_name" />
                                </div>
                                <div class="col-md-4 form-group text-input-container">
                                    <label class="control-label">Last Name</label><span>*</span>
                                    <input type="text" name="last_name"
                                           v-model="rowData.last_name"
                                           id="last_name"
                                           required
                                           placeholder="Enter last name" class="form-control" 
                                           v-bind:value="rowData.last_name" />
                                </div>
                                <div class="col-md-4 form-group text-input-container">
                                    <label class="control-label">Manpower Type</label>
                                    <select type="date" name="manpower_type_id"
                                            v-model="rowData.manpower_type_id"
                                           id="manpower_type_id"
                                           placeholder="Select..." class="form-control">
                                           <option v-for="manpowerType in manpowerTypeList" :value="manpowerType.id" v-bind:selected="rowData.manpower_type_id == manpowerType.id">{{manpowerType.name}}</option>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group text-input-container">
                                    <label class="control-label">Agency</label>
                                    <select type="date" name="agency_id"
                                            v-model="rowData.agency_id"
                                           id="agency_id"
                                           placeholder="Select..." class="form-control">
                                           <option v-for="agency in agencyList" :value="agency.id" v-bind:selected="rowData.agency_id == agency.id">{{agency.name}}</option>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group text-input-container">
                                    <label class="control-label">Birth Date</label><span>*</span>
                                    <input type="date" name="birthdate"
                                            v-model="rowData.birthdate"
                                            max="2010-01-01"
                                            required
                                           id="birthdate"
                                           class="form-control" 
                                           :value="rowData.birthdate" />
                                </div>
                                <div class="col-md-4 form-group text-input-container">
                                    <label class="control-label">City</label>
                                    <input type="city" name="city"
                                            v-model="rowData.city"
                                           id="last_name"
                                           placeholder="Enter City" class="form-control" 
                                           v-bind:value="rowData.city" />
                                </div>
                                <div class="col-md-4 form-group text-input-container">
                                    <label class="control-label">Email Address</label>
                                    <input type="email" name="email"
                                            v-model="rowData.email"
                                           id="last_email"
                                           placeholder="Enter Email Address" class="form-control" 
                                           v-bind:value="rowData.email" />
                                </div>
                                <div class="col-md-4 form-group text-input-container">
                                    <label class="control-label">Contact Number</label>
                                    <input type="text" name="contact_number"
                                            v-model="rowData.contact_number"
                                           id="contact_number"
                                           placeholder="Enter contact number" class="form-control" 
                                           v-bind:value="rowData.contact_number" />
                                </div>
                                <div class="col-md-4 form-group text-input-container">
                                    <label class="control-label">Facebook Profile Link</label>
                                    <input type="text" name="fb_link"
                                            v-model="rowData.fb_link"
                                           id="fb_link"
                                           placeholder="Facebook Link" class="form-control" 
                                           v-bind:value="rowData.fb_link" />
                                </div>
                                <div class="col-md-4 form-group text-input-container">
                                    <label class="control-label">Date Hired</label>
                                    <input type="date" name="hired_date"
                                            v-model="rowData.hired_date"
                                           id="hired_date"
                                           class="form-control" 
                                           v-bind:value="rowData.hired_date" />
                                </div>
                                <div class="col-md-4 form-group text-input-container">
                                    <label class="control-label">Violations</label>
                                    <input type="text" name="violations"
                                            v-model="rowData.violations"
                                           id="violations"
                                           placeholder="Enter violations" class="form-control" 
                                           v-bind:value="rowData.violations" />
                                </div>
                                <div class="col-md-4 form-group text-input-container">
                                    <label class="control-label">Rate</label>
                                    <input type="number" name="rate"
                                            v-model="rowData.rate"
                                           id="rate"
                                           placeholder="Enter Rate" class="form-control" 
                                           v-bind:value="rowData.rate" />
                                </div>
                                <div class="col-md-4 form-group text-input-container">
                                    <label class="control-label">Documents</label>
                                    <input type="file" name="documents[]"
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
    import VueEvents from 'vue-events';
    
    Vue.use(VueEvents);
    Vue.component('CustomActions', CustomActions);

    export default {
        components: {
            Vuetable
        },
        mounted() {
        	this.getManpowerType();
            this.getAgency();

            $('#createManpower').on('hidden.bs.modal', (e) => {
               this.rowData = {
                    'first_name': null,
                    'middle_name': null,
                    'manpower_type_id': 1,
                    'agency_id': 1,
                    'birthdate': null,
                    'city': null,
                    'email': null,
                    'contact_number': null,
                    'fb_link': null,
                    'hired_date': null,
                    'violations': null,
                    'rate': null
                }; // reset form data 
            });


        },
        data() {
        	return {
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
                        sortField: 'birthdate',
                        titleClass: 'text-center',
                        dataClass: 'text-center',
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
                        titleClass: 'text-center',
                        dataClass: 'text-center',
                        callback: 'formatDate|DD-MM-YYYY',
                        title: 'Last Updated'
        			},
					{
						name: '__handle',   // <----
						dataClass: 'center aligned'
					},
					{
                        name: '__component:CustomActions',
                        title: 'Actions',
                        titleClass: 'text-center',
                        dataClass: 'text-center middleAlign'
                    }
        		],
                isFetching : {
                    disabled : false,
                    saveLabel : 'Save'
                },
                manpowerTypeList : [],
                agencyList : [],
                rowData : {
                    'first_name': null,
                    'middle_name': null,
                    'manpower_type_id': 1,
                    'agency_id': 1,
                    'birthdate': null,
                    'city': null,
                    'email': null,
                    'contact_number': null,
                    'fb_link': null,
                    'hired_date': null,
                    'violations': null,
                    'rate': null
                }

        	}
        },
        methods: {
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
            onSubmitForm(e) {
                this.isFetching = {
                    disabled: true,
                    saveLabel: 'Saving...'
                }
                
                let form = new FormData($(e.target)[0]);
                // for (var pair of form.entries()) {
                //     console.log(pair[0]+ ', ' + pair[1]); 
                // }
                // return;
                if(this.rowData.id) // EDIT
                {
                    let url = '/api/v1/hr/manpower/' + this.rowData.id;
                    this.$http.post(url,form).then(response => {
                        toastr.success('Successfully editted manpower', 'Success')
                        console.log(response);
                        this.isFetching = {
                            disabled: false,
                            saveLabel: 'Save'
                        };
                        
                        $('#createManpower').modal('hide');
                        this.$refs.Vuetable_manpower.reload(); // refresh vuetable
                    }, error => {
                        toastr.error('Failed in editing manpower', 'Error')
                        console.log(error)
                        this.isFetching = {
                            disabled: false,
                            saveLabel: 'Save'
                        }
                    });

                    return;
                }

                let url = '/api/v1/hr/manpower';
                this.$http.post(url,form).then(response => {
                    toastr.success('Successfully added new manpower', 'Success')
                    console.log(response);
                    this.isFetching = {
                        disabled: false,
                        saveLabel: 'Save'
                    };
                    
                    $('#createManpower').modal('hide');
                    this.$refs.Vuetable_manpower.refresh(); // refresh vuetable
                }, error => {
                    toastr.error('Failed in adding new manpower', 'Error')
                    console.log(error)
                    this.isFetching = {
                        disabled: false,
                        saveLabel: 'Save'
                    }
                });
                
            },
            getManpowerType() {
                let url = '/api/v1/manpower-types/all';
                this.$http.get(url).then(response => {
                    this.manpowerTypeList = response.data;
                    // console.log(response);
                }, error => {
                    console.log(error) 
                    
                });
            },
            getAgency() {
                let url = '/api/v1/agencies';
                this.$http.get(url).then(response => {
                    this.agencyList = response.data.data;
                    
                }, error => {
                    console.log(error)
                    
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
            'edit-table' (data) {
                data.birthdate = data.birthdate ? moment(data.birthdate).format('YYYY-MM-DD') : null;
                data.hired_date = data.hired_date ? moment(data.hired_date).format('YYYY-MM-DD') : null;
                Vue.nextTick( 
                    () => {
                        this.rowData = data
                        $('#createManpower').modal('show');
                    }
                )
            }
        }
    }
</script>

<style>
    .customWith10 {
        width : 10%;
    }
    .middleAlign {
        vertical-align: middle !important;
    }

</style>