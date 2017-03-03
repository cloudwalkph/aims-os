<template>
    <div>
        <!--<plan-animation-details-filter-bar></plan-animation-details-filter-bar>-->
        <vuetable ref="vuetable"
                  api-url="/api/v1/job-order-animation-details"
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
    import PlanAnimationDetailsFilterBar from './animation-details/FilterBar'

    Vue.use(VueEvents)
    Vue.component('plan-animation-details-filter-bar', PlanAnimationDetailsFilterBar)

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
                        name: 'particular',
                        sortField: 'particular',
                        title: 'Particulars'
                    },
                    {
                        name: 'target_activity',
                        sortField: 'target_activity',
                        title: 'Target Activity'
                    },
                    {
                        name: 'target_selling',
                        sortField: 'target_selling',
                        title: 'Target Selling'
                    },
                    {
                        name: 'target_flyering',
                        sortField: 'target_flyering',
                        title: 'Target Flyering'
                    },
                    {
                        name: 'target_survey',
                        sortField: 'target_survey',
                        title: 'Target Survey'
                    },
                    {
                        name: 'target_experiment',
                        sortField: 'target_experiment',
                        title: 'Target Experiential'
                    },
                    {
                        name: 'target_others',
                        sortField: 'target_others',
                        title: 'Others'
                    },
                    {
                        name: 'target_duration',
                        sortField: 'target_duration',
                        title: 'Target Duration'
                    },
                    {
                        name: 'target_areas',
                        sortField: 'target_areas',
                        title: 'Areas'
                    },
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
                    { field: 'particular', sortField: 'particular', direction: 'asc'}
                ],
                moreParams: {}
            }
        },
        methods: {
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