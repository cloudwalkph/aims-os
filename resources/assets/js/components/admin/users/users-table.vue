<template>
    <div>
        <filter-bar></filter-bar>
        <vuetable ref="vuetable"
                  api-url="/api/v1/users/"
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

        <user-modal></user-modal>
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
    import UserModal from './commons/form.vue'

    Vue.use(VueEvents)
    Vue.component('user-custom-actions', CustomActions)
    Vue.component('filter-bar', FilterBar)
    Vue.component('user-modal', UserModal)

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
                        name: 'full_name',
                        sortField: 'full_name',
                        title: 'Full Name'
                    },
                    {
                        name: 'email',
                        sortField: 'email',
                        title: 'E-Mail Address',
                        callback: 'allcap'
                    },
                    {
                        name: 'department',
                        sortField: 'department',
                        title: 'Department'
                    },
                    {
                        name: 'user_role',
                        sortField: 'user_role',
                        title: 'User Role'
                    },
                    {
                        name: 'gender',
                        sortField: 'gender',
                        title: 'Gender',
                        titleClass: 'text-center',
                        dataClass: 'text-center'
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
                        name: '__component:user-custom-actions',
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
            allcap (value) {
                return value.toUpperCase()
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