<template>
    <div class="filter-bar">
      <form class="form-inline">
        <div class="form-group">
          <label>Search for:</label>
          <input type="text" v-model="filterText" class="form-control" @keyup.enter="(() => doFilter)" placeholder="">
          <button class="btn btn-primary" @click.prevent="doFilter">Go</button>
          <button class="btn" @click.prevent="resetFilter">Reset</button>
        </div>
      </form>
    </div>
</template>

<script>
  module.exports = {
    data: function() {
      return {
        filterText: ''
      }
    },
    methods: {
      doFilter () {
        this.filterSet(this.filterText);
      },
      resetFilter () {
        this.filterText = '';
        this.filterReset();
      }
    },
    props: {
      filterSet: Function,
      filterReset: Function,
    }
  }
</script>
