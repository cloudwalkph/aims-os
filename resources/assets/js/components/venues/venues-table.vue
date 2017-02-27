<template>
    <div>
        <filter-bar></filter-bar>
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
    import CustomActions from './commons/CustomActions'
    import FilterBar from './commons/FilterBar'
    import VenueModal from './commons/form.vue'

    Vue.use(VueEvents)
    Vue.component('ongoing-custom-actions', CustomActions)
    Vue.component('filter-bar', FilterBar)
    Vue.component('venues-modal', VenueModal)

    export default {
        components: {
            Vuetable,
            VuetablePagination,
            VuetablePaginationInfo,
        },
        data() {
            return {
                fields: [
                    {
                        name: '__sequence',
                        title: '#',
                        titleClass: 'text-right',
                        dataClass: 'text-right'
                    },
                    {
                        name: '__checkbox',
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
                        name: 'address',
                        sortField: 'address',
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
                        name: 'actual_hits',
                        sortField: 'actual_hits',
                        title: 'Actual Hits Male'
                    },
                    {
                        name: 'actual_hits_f',
                        sortField: 'actual_hits_f',
                        title: 'Actual Hits Female'
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
                        title: 'email'
                    },
                    {
                        name: 'created_at',
                        sortField: 'created_at',
                        titleClass: 'text-center',
                        dataClass: 'text-center',
                        callback: 'formatDate|DD-MM-YYYY',
                        title: 'Created Date'
                    },
                    {
                        name: '__component:ongoing-custom-actions',
                        title: 'Actions',
                        titleClass: 'text-center',
                        dataClass: 'text-center'
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
        },
        events: {
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