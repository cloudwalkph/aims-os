<template>
    <div>
        <activations-jo-filter-bar></activations-jo-filter-bar>
        <vuetable ref="vuetable"
                  :api-url="apiUrl"
                  :fields="fields"
                  pagination-path=""
                  :css="css.table"
                  :sort-order="sortOrder"
                  :multi-sort="true"
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
</template>

<script>
    import accounting from 'accounting'
    import moment from 'moment'
    import Vuetable from 'vuetable-2/src/components/Vuetable'
    import VuetablePagination from 'vuetable-2/src/components/VuetablePagination'
    import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo'
    import Vue from 'vue'
    import VueEvents from 'vue-events'
    import ActivationsJoCustomActions from './commons/CustomActions'
    import ActivationsJoFilterBar from './commons/FilterBar'

    Vue.use(VueEvents)
    Vue.component('activations-jo-actions', ActivationsJoCustomActions)
    Vue.component('activations-jo-filter-bar', ActivationsJoFilterBar)

    export default {
        components: {
            Vuetable,
            VuetablePagination,
            VuetablePaginationInfo,
        },
        data () {
            return {
                apiUrl: `/api/v1/job-orders/department/11/`,
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
                        name: 'job_order_no',
                        sortField: 'job_order_no',
                        title: 'Job Order #'
                    },
                    {
                        name: 'project_name',
                        sortField: 'project_name',
                        title: 'Project Title'
                    },
                    {
                        name: 'created_at',
                        sortField: 'created_at',
                        title: 'Event Date',
                        dataClass: 'text-capitalize',
                        callback: 'formatDate|DD-MM-YYYY'
                    },
                    {
                        name: 'created_by',
                        sortField: 'created_by',
                        title: 'Project Manager'
                    },
                    {
                        name: 'status',
                        sortField: 'status',
                        title: 'Status'
                    },
                    {
                        name: '__component:activations-jo-actions',
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
                    { field: 'job_order_no', sortField: 'job_order_no', direction: 'asc'}
                ],
                moreParams: {}
            }
        },
        methods: {
            lowercap (value) {
                return value.toLowerCase()
            },
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
            onCellClicked (data, field, event) {
                console.log('cellClicked: ', field.name)
                this.$refs.vuetable.toggleDetailRow(data.id)
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
