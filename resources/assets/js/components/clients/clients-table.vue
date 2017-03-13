<template>
    <div>
        <client-filter-bar></client-filter-bar>
        <vuetable ref="vuetable"
                  api-url="/api/v1/clients"
                  :fields="fields"
                  pagination-path=""
                  :css="css.table"
                  :sort-order="sortOrder"
                  :multi-sort="true"
                  detail-row-component="client-detail-row"
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

        <create-client-form-modal></create-client-form-modal>
        <client-update-modal ref="updateClient"></client-update-modal>
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
    import DetailRow from './commons/DetailRow'
    import FilterBar from './commons/FilterBar'
    import CreateClientModal from './commons/form.vue'
    import EditModal from './commons/edit-form.vue'

    Vue.use(VueEvents)
    Vue.component('client-custom-actions', CustomActions)
    Vue.component('client-detail-row', DetailRow)
    Vue.component('client-filter-bar', FilterBar)
    Vue.component('create-client-form-modal', CreateClientModal)
    Vue.component('client-update-modal', EditModal)

    export default {
        components: {
            Vuetable,
            VuetablePagination,
            VuetablePaginationInfo,
        },
        data () {
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
                        name: 'company',
                        sortField: 'company',
                        title: 'Company'
                    },
                    {
                        name: 'contact_person',
                        sortField: 'contact_person',
                        title: 'Contact Person'
                    },
                    {
                        name: 'contact_number',
                        sortField: 'contact_number',
                        title: 'Contact #'
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
                        sortField: 'email',
                        title: 'Email',
                        callback: 'allcap'
                    },
                    {
                        name: 'brands',
                        sortField: 'brands',
                        title: 'Brands',
                        titleClass: 'text-center',
                        dataClass: 'text-center',
                        callback: 'brandsDisseminate'
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
                        name: '__component:client-custom-actions',
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
                    { field: 'email', sortField: 'email', direction: 'asc'}
                ],
                moreParams: {}
            }
        },
        methods: {
            allcap (value) {
                return value.toUpperCase()
            },
            brandsDisseminate (value) {
                return JSON.parse(value).map(elem => { return elem.name }).join(', ')
            },
//            genderLabel (value) {
//                return value === 'M'
//                    ? '<span class="label label-success"><i class="glyphicon glyphicon-star"></i> Male</span>'
//                    : '<span class="label label-danger"><i class="glyphicon glyphicon-heart"></i> Female</span>'
//            },
//            formatNumber (value) {
//                return accounting.formatNumber(value, 2)
//            },
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
            },
            'update-client-show' (data) {
                Vue.nextTick(() => {
                    this.$refs.updateClient.populateData(data)
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