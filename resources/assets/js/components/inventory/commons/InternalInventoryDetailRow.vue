<template>
  <div class="row">
    <div class="col-sm-12">
      <div class="row" v-if="pictures.length > 0">
        <div class="col-sm-3" v-for="picture in pictures">
           <img :src="picture.url" class="img-rounded" :alt="picture.url" width="200">
        </div>
      </div>
      <div v-else>
         No images to display
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      pictures: []
    }
  },
  props: {
    rowData: {
      type: Object,
      required: true
    },
    rowIndex: {
      type: Number
    }
  },
  methods: {
    onClick (event) {
      console.log('my-detail-row: on-click', event.target)
    },
    getInventoryFiles: function() {
      this.$http.get('api/v1/inventory/' + this.rowData.id)
          .then(function (response) {
            this.pictures = response.data.inventory_files;
          })
          .catch(function (e) {
              console.log('error post jobs', e);
          });
    }
  },
  mounted: function() {
    this.getInventoryFiles();
  }
}
</script>
