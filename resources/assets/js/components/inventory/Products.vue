<template>

    <div class="row">
        <div class="col-sm-12">
            <h1>Product List</h1>
            <button class="btn btn-default pull-right" onclick="frames['productListFrame'].print()">
                <i class="fa fa-print fa-lg"></i> Print Product List
            </button>
        </div>
        <div class="col-md-12">
            <div class="content">
              <filter-bar></filter-bar>
              <vuetable ref="vuetable"
                api-url="/api/v1/job-order-inventory/all"
                :fields="fields"
                pagination-path=""
                :css="css.table"
                :sort-order="sortOrder"
                :multi-sort="true"
                detail-row-component="my-detail-row"
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

        <iframe name="productListFrame" :src="frameSrc" style="width:0; height:0"></iframe>
    </div>

</template>

<script>
    var Vuetable = require('vuetable-2/src/components/Vuetable');
    var VuetablePagination = require('vuetable-2/src/components/VuetablePagination');
    var VuetablePaginationInfo = require('vuetable-2/src/components/VuetablePaginationInfo');

    var FilterBar = require('../commons/FilterBar');

    module.exports = {
        components: {
          Vuetable,
          VuetablePagination,
          VuetablePaginationInfo,
          FilterBar
        },
        data: function () {
            return {
              frameSrc: '/inventory/print/product',
              fields: [
                {
                  name: 'job_order_no',
                  title: 'Job Order Number',
                  sortField: 'job_order_no',
                },
                {
                  name: 'project_name',
                  title: 'Project Name',
                  sortField: 'project_name',
                },
                {
                  name: 'item_name',
                  title: 'Item Name',
                  sortField: 'item_name',
                },
                {
                  name: 'expected_quantity',
                  title: 'Expected Quantity',
                },
                {
                  name: 'products_on_hand',
                  title: 'Products on Hand',
                },
                {
                  name: 'disposed',
                  title: 'Disposed'
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
                { field: 'id', direction: 'asc'}
              ],
              moreParams: {},
              products: this.propData.products,
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
          }
        },
        methods: {
          onCellClicked (data, field, event) {
            console.log('cellClicked: ', field.name)
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
        mounted: function () {
        },
        props: ['propData']
    }

</script>
