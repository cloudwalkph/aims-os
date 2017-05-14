<template>

    <div class="row">
        <div class="col-md-12">
            <h1 class="pull-left table-title">Ongoing Project</h1>
            <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modalCreateJob">
                <i class="fa fa-plus"></i> Create Job
            </button>
            <div class="content">
              <filter-bar></filter-bar>
              <vuetable ref="vuetable"
                api-url="/api/v1/inventory/job"
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
        <component is="create-job-modal" :propData="propData">
        </component>
    </div>

</template>

<script>
  var CreateJobModal = require('./modals/CreateJob');

  var Vuetable = require('vuetable-2/src/components/Vuetable');
  var VuetablePagination = require('vuetable-2/src/components/VuetablePagination');
  var VuetablePaginationInfo = require('vuetable-2/src/components/VuetablePaginationInfo');

  var DetailRow = require('../commons/DetailRow');
  var FilterBar = require('../commons/FilterBar');

  Vue.component('my-detail-row', DetailRow);

    module.exports = {
        components: {
          Vuetable,
          VuetablePagination,
          VuetablePaginationInfo,
          CreateJobModal,
          FilterBar,
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
                  name: 'project_name',
                  title: 'Project Name',
                  sortField: 'project_name',
                },
                {
                  name: 'remarks',
                  title: 'Description',
                },
                {
                  name: 'deadline',
                  title: 'Deadline',
                  sortField: 'deadline',
                  callback: 'convertDate'
                },
                {
                  name: 'first_name',
                  title: 'Assigned Persons',
                  sortField: 'first_name',
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
                jobs: this.propData.inventoryJobs
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
        mounted: function () {
        },
        props: ['propData']
    }

</script>
