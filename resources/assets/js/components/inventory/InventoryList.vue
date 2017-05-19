<template>

    <div class="row">
        <div class="col-md-12">
            <h1 class="pull-left table-title">Inventory List</h1>
            <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modalCreateInventory">
                <i class="fa fa-plus" /> Create Inventory
            </button>
            <div class="content">
              <filter-bar></filter-bar>
              <vuetable ref="vuetable"
                api-url="/api/v1/inventory"
                :fields="fields"
                pagination-path=""
                :css="css.table"
                :sort-order="sortOrder"
                :multi-sort="true"
                detail-row-component="internal-inventory-detail-row"
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
        </div>
        <CreateInventoryModal :propData="propData"></CreateInventoryModal>
    </div>

</template>

<script>
    var CreateInventoryModal = require('./modals/CreateInventory.vue');

    var Vuetable = require('vuetable-2/src/components/Vuetable');
    var VuetablePagination = require('vuetable-2/src/components/VuetablePagination');
    var VuetablePaginationInfo = require('vuetable-2/src/components/VuetablePaginationInfo');

    var FilterBar = require('../commons/FilterBar');

    var InternalInventoryDetailRow = require('./commons/InternalInventoryDetailRow');
    Vue.component('internal-inventory-detail-row', InternalInventoryDetailRow);

    module.exports = {
        components: {
          Vuetable,
          VuetablePagination,
          VuetablePaginationInfo,
          FilterBar,
            CreateInventoryModal,
        },
        data: function () {
            return {
              fields: [
                {
                  name: 'job_order_no',
                  title: 'Job Order Number',
                  sortField: 'job_order_no',
                },
                {
                  name: 'category',
                  title: 'Category',
                  sortField: 'category',
                },
                {
                  name: 'product_code',
                  title: 'SKU',
                  sortField: 'product_code',
                },
                {
                  name: 'name',
                  title: 'Inventory Name',
                  sortField: 'name',
                },
                {
                  name: 'quantity',
                  title: 'Quantity',
                  sortField: 'quantity',
                },
                {
                  name: 'expiration_date',
                  title: 'Expiration Date',
                  callback: 'convertDate',
                  sortField: 'expiration_date',
                },
                {
                  name: 'status',
                  title: 'Status',
                  sortField: 'status',
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
                { field: 'id', direction: 'asc'}
              ],
              moreParams: {},
            }
        },
        events: {
          'filter-set' (filterText) {
            this.moreParams = {
              filter: filterText
            },
            Vue.nextTick( () => this.$refs.vuetable.refresh() )
          },
          'filter-reset' () {
            this.moreParams = {},
            Vue.nextTick( () => this.$refs.vuetable.refresh() )
          },
        },
        methods: {
          onCellClicked (data, field, event) {
            this.$refs.vuetable.toggleDetailRow(data.id)
          },
          onChangePage (page) {
            this.$refs.vuetable.changePage(page);
          },
          onPaginationData (paginationData) {
            this.$refs.pagination.setPaginationData(paginationData);
            this.$refs.paginationInfo.setPaginationData(paginationData);
          },
            convertDate: function (dateVal) {
                var milliseconds = Date.parse(dateVal);
                var d = new Date(milliseconds);
                return d.toDateString();
            },
        },
        mounted: function() {
        },
        props: ['propData']
    }

</script>
