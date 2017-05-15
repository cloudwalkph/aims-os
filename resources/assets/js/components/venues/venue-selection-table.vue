<template>
    <div>
        <div class="col-md-12 venues" style="margin-top: 20px">
            <venue-selection-filter-bar></venue-selection-filter-bar>
            <vuetable ref="vuetable"
                      api-url="/api/v1/venues"
                      :fields="fields"
                      pagination-path=""
                      :css="css.table"
                      :sort-order="sortOrder"
                      :multi-sort="true"
                      detail-row-component="my-detail-row"
                      :append-params="moreParams"
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

            <venues-modal></venues-modal>
            <venues-update-modal ref="updateVenues"></venues-update-modal>
        </div>

        <hr/>

        <div class="col-md-12" style="margin-top: 50px">
            <h4>
                Selected Venues
                <i class="fa fa-print fa-lg pull-right" ></i>
            </h4>
        </div>

        <div class="col-md-12">
            <table class="table table-striped table-bordered" id="selectedVenueTable">
                <thead>
                <tr>
                    <th>Venue</th>
                    <th>Estimated Foot Traffic</th>
                    <th>Actual Hits</th>
                    <th>Rate</th>
                    <th>Remarks</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <tr v-show="selectedVenues.length <= 0">
                        <td colspan="6"><span style="text-align: center">No Selected Venue/s Yet</span></td>
                    </tr>

                    <tr v-for="(venue, index) in selectedVenues">
                        <td>{{ venue.venue  }}</td>
                        <td>{{ venue.eft  }}</td>
                        <td>{{ venue.actual_hits }}</td>
                        <td>{{ venue.rate }}</td>
                        <td>{{ venue.remarks }}</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-6 col-md-offset-2">
            <h5 class="pull-right">Total Traffic Count: {{ selectedVenueCount }}</h5>
        </div>
        <div class="col-md-4">
            <button type="button" class="btn btn-primary pull-right btn-block" @click="saveSelectedVenues"> Save Selected Venues</button>
        </div>
    </div>


</template>


<script>
    import accounting from 'accounting'
    import moment from 'moment'
    import Vuetable from 'vuetable-2/src/components/Vuetable'
    import VuetablePagination from 'vuetable-2/src/components/VuetablePagination'
    import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo'
    import Vue from 'vue'
    import VueEvents from 'vue-events'
    import VenueSelector from './commons/VenueSelector'
    import SelectionFilterBar from './commons/SelectionFilterBar'
    import VenueModal from './commons/form.vue'
    import VenueEditModal from './commons/edit-form.vue'

    Vue.use(VueEvents)
    Vue.component('venues-selector', VenueSelector)
    Vue.component('venue-selection-filter-bar', SelectionFilterBar)
    Vue.component('venues-modal', VenueModal)
    Vue.component('venues-update-modal', VenueEditModal)

    export default {
        components: {
            Vuetable,
            VuetablePagination,
            VuetablePaginationInfo,
        },
        data() {
            return {
                selectedVenues: [],
                selectedVenueCount: 0,
                selectedVenueIds: [],
                fields: [
                    {
                        name: '__sequence',
                        title: '#',
                        titleClass: 'text-right',
                        dataClass: 'text-right'
                    },
                    {
                        name: '__component:venues-selector',
                        titleClass: 'text-center',
                        dataClass: 'text-center',
                    },
                    {
                        name: 'category',
                        sortField: 'category',
                        title: 'Category'
                    },
                    {
                        name: 'subcategory',
                        sortField: 'subcategory',
                        title: 'Sub Category'
                    },
                    {
                        name: 'area',
                        sortField: 'area',
                        title: 'Area'
                    },
                    {
                        name: 'sub_area',
                        sortField: 'sub_area',
                        title: 'Sub Area'
                    },
                    {
                        name: 'venue',
                        sortField: 'venue',
                        title: 'Venue'
                    },
                    {
                        name: 'street',
                        sortField: 'street',
                        title: 'Address'
                    },
                    {
                        name: 'lsm',
                        sortField: 'lsm',
                        title: 'LSM'
                    },
                    {
                        name: 'rate',
                        sortField: 'rate',
                        title: 'Rate Min'
                    },
                    {
                        name: 'rate_max',
                        sortField: 'rate_max',
                        title: 'Rate Max'
                    },
                    {
                        name: 'eft',
                        sortField: 'eft',
                        title: 'EFT Combined'
                    },
                    {
                        name: 'eft_male',
                        sortField: 'eft_male',
                        title: 'EFT Male'
                    },
                    {
                        name: 'eft_female',
                        sortField: 'eft_female',
                        title: 'EFT Female'
                    },
                    {
                        name: 'actual_dry_m',
                        sortField: 'actual_dry_m',
                        title: 'Dry Sampling - Male'
                    },
                    {
                        name: 'actual_dry_f',
                        sortField: 'actual_dry_f',
                        title: 'Dry Sampling - Female'
                    },
                    {
                        name: 'actual_exper_m',
                        sortField: 'actual_exper_m',
                        title: 'Experiential Sampling - Male'
                    },
                    {
                        name: 'actual_exper_f',
                        sortField: 'actual_exper_f',
                        title: 'Experiential Sampling - Female'
                    },
                    {
                        name: 'contact_person',
                        sortField: 'contact_person',
                        title: 'Name'
                    },
                    {
                        name: 'contact_number',
                        sortField: 'contact_number',
                        title: 'Phone'
                    },
                    {
                        name: 'contact_email',
                        sortField: 'contact_email',
                        title: 'Email'
                    },
                    {
                        name: 'created_at',
                        sortField: 'created_at',
                        titleClass: 'text-center',
                        dataClass: 'text-center',
                        callback: 'formatDate|DD-MM-YYYY',
                        title: 'Created Date'
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
                    },
                },
                sortOrder: [
                    { field: 'created_at', sortField: 'created_at', direction: 'asc'}
                ],
                moreParams: {}
            }
        },
        mounted() {
            this.getSelectedVenues();
        },
        methods: {
            formatDate (value, fmt = 'D MMM YYYY') {
                return (value == null)
                    ? ''
                    : moment(value, 'YYYY-MM-DD').format(fmt)
            },
            onPaginationData (paginationData) {
                this.$refs.pagination.setPaginationData(paginationData)
                this.$refs.paginationInfo.setPaginationData(paginationData)
            },
            onChangePage (page) {
                this.$refs.vuetable.changePage(page)
            },
            countTrafficOnSelectedVenues() {
                this.selectedVenueIds = [];

                for (let venue of this.selectedVenues) {
                    this.selectedVenueCount = parseInt(this.selectedVenueCount) + parseInt(venue.eft);
                    this.selectedVenueIds.push(venue.id);
                }
            },
            addOrDeleteSelectedVenue(data) {
                let found = this.selectedVenues.findIndex((venue) => venue.id === data.id);

                if (found >= 0) {
                    this.selectedVenues.splice(found, 1);
                } else {
                    this.selectedVenues.push(data);
                }

                this.countTrafficOnSelectedVenues();
            },
            getSelectedVenues() {
                let jobOrderId = $('#jobOrderId').val();

                if (! jobOrderId) {
                    toastr.error('No jo number found', 'Error');

                    return;
                }

                let url = `/api/v1/venues/plans/job-order/${jobOrderId}`;
                this.$http.get(url).then(response => {
                    console.log(response)
                    this.selectedVenues = response;
                }, error => {
                    console.log(error)
                })
            },
            saveSelectedVenues() {
                let jobOrderId = $('#jobOrderId').val();

                if (! jobOrderId) {
                    toastr.error('No jo number found', 'Error');

                    return;
                }

                let data = {
                    selectedVenues: this.selectedVenues
                };

                let url = `/api/v1/venues/plans/job-order/${jobOrderId}`;
                this.$http.post(url, data).then(response => {
                    console.log(response)

                    toastr.success('Successfully created a plan', 'Success')
                }, error => {
                    toastr.error('Failed in creating a plan', 'Error')
                    console.log(error)
                })
            }
        },
        events: {
            'selected-venue' (data) {
                Vue.nextTick( () => this.addOrDeleteSelectedVenue(data) )
            },
            'filter-set' (filterText) {
                this.moreParams = {
                    filter: filterText
                }
                Vue.nextTick( () => this.$refs.vuetable.refresh() )
            },
            'reload-table' () {
                Vue.nextTick( () => this.$refs.vuetable.reload() )
            },
            'filter-reset' () {
                this.moreParams = {}
                Vue.nextTick( () => this.$refs.vuetable.refresh() )
            },
            'update-venues-show' (data) {
                Vue.nextTick(() => {
                    this.$refs.updateVenues.populateData(data)
                })
            }
        }
    }
</script>
<style>
    .pagination {
        margin: 0;
        float: right;
    }
    .pagination a.page {
        border: 1px solid lightgray;
        border-radius: 3px;
        padding: 5px 10px;
        margin-right: 2px;
    }
    .pagination a.page.active {
        color: white;
        background-color: #337ab7;
        border: 1px solid lightgray;
        border-radius: 3px;
        padding: 5px 10px;
        margin-right: 2px;
    }
    .pagination a.btn-nav {
        border: 1px solid lightgray;
        border-radius: 3px;
        padding: 5px 7px;
        margin-right: 2px;
    }
    .pagination a.btn-nav.disabled {
        color: lightgray;
        border: 1px solid lightgray;
        border-radius: 3px;
        padding: 5px 7px;
        margin-right: 2px;
        cursor: not-allowed;
    }
    .pagination-info {
        float: left;
    }
</style>