<template>
  <div>
    <filter-bar
      :filterSet="filterSet"
      :filterReset="filterReset"
    ></filter-bar>
    <vuetable ref="vuetableInventory"
      :api-url="apiUrl"
      :fields="fields"
      :css="css.table"
      :sort-order="sortOrder"
      :multi-sort="true"
      :detail-row-component="detailRowComponent"
      :append-params="appendParams"
      @vuetable:cell-clicked="onCellClicked"
      @vuetable:row-clicked="onRowClicked"
      @vuetable:pagination-data="onPaginationData"
      pagination-path=""
      pagination-component="vuetable-pagination"
      data-path="data"
    ></vuetable>
    <div class="vuetable-pagination ui basic segment grid">
      <vuetable-pagination-info ref="paginationInfo"
      ></vuetable-pagination-info>

      <vuetable-pagination ref="pagination"
          :css="css.pagination"
          @vuetable-pagination:change-page="onChangePage"
          ></vuetable-pagination>
    </div>
  </div>
</template>

<script>
  var Vuetable = require('vuetable-2/src/components/Vuetable');
  var VuetablePagination = require('vuetable-2/src/components/VuetablePagination');
  var VuetablePaginationInfo = require('vuetable-2/src/components/VuetablePaginationInfo');

  var FilterBar = require('../../commons/FilterBar');
  var DetailRow = require('../../commons/DetailRow');

  module.exports = {
    components: {
      DetailRow,
      Vuetable,
      VuetablePagination,
      VuetablePaginationInfo,
      FilterBar
    },
    computed: {
      appendParams: function () {
        return this.moreParams;
      }
    },
    data: function () {
      return {
        css: {
          table: {
            tableClass: 'table table-bordered table-striped table-hover',
            ascendingIcon: 'glyphicon glyphicon-chevron-up',
            descendingIcon: 'glyphicon glyphicon-chevron-down'
          },
          pagination: {
              wrapperClass: 'pagination pull-right',
              activeClass: 'btn-primary',
              disabledClass: 'disabled',
              pageClass: 'btn btn-border',
              linkClass: 'btn btn-border',
              icons: {
                  first: '',
                  prev: '',
                  next: '',
                  last: '',
              }
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
      }
    },
    methods: {
      convertDate (dateVal) {
        var milliseconds = Date.parse(dateVal);
        if(milliseconds > 0) {
          var d = new Date(milliseconds);
          return d.toDateString();
        }
        return 'NA';
      },
      getAssignedPerson (val) {
        var person = [];
        val.map(function(value, index) {
          person.push(value.user.profile.first_name + ' ' + value.user.profile.last_name);
        });
        return person.join(', ');
      },
      filterSet (filterText) {
        this.appendParams.filter = filterText,
        Vue.nextTick( () => this.$refs.vuetableInventory.refresh() )
      },
      filterReset () {
        this.appendParams.filter = {},
        Vue.nextTick( () => this.$refs.vuetableInventory.refresh() )
      },
      onCellClicked (data, field, event) {
        console.log('cellClicked: ', field.name)
      },
      onPaginationData (paginationData) {
        this.$refs.pagination.setPaginationData(paginationData)
        this.$refs.paginationInfo.setPaginationData(paginationData)
      },
      onChangePage (page) {
          this.$refs.vuetableInventory.changePage(page)
      },
    },
    mounted: function () {

    },
    props: {
      apiUrl: {
        default: '',
        type: String
      },
      detailRowComponent: {
        default: 'detailRow',
        type: String
      },
      fields: {
        default: function () { return [] },
        type: Array
      },
      moreParams: {
        default: function () { return {} },
        type: Object
      },
      onRowClicked: {
        default: function () {},
        type: Function
      },
    }
  }
</script>
