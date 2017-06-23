<template>
    <div>
        <operations-inventory-jo-filter-bar></operations-inventory-jo-filter-bar>
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
    import OperationsInventoryJoCustomActions from './commons/CustomActions'
    import OperationsInventoryJoFilterBar from './commons/FilterBar'

    Vue.use(VueEvents)
    Vue.component('operations-inventory-jo-actions', OperationsInventoryJoCustomActions)
    Vue.component('operations-inventory-jo-filter-bar', OperationsInventoryJoFilterBar)

    export default {
        components: {
            Vuetable,
            VuetablePagination,
            VuetablePaginationInfo,
        },
        data () {
            return {
                apiUrl: `/api/v1/job-orders/department/${$('#departmentId').val()}/`,
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
                        name: 'created_by',
                        sortField: 'created_by',
                        title: 'Created By',
                        dataClass: 'text-capitalize',
                        callback: 'lowercap'
                    },
                    {
                        name: 'project_name',
                        sortField: 'project_name',
                        title: 'Project Name'
                    },
                    {
                        name: 'status',
                        sortField: 'status',
                        title: 'Status',
                        callback: 'lowercap'
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
                        name: '__component:operations-inventory-jo-actions',
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
