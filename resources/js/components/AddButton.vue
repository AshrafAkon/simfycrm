<template>
  <td class="text-center border-right-0 border-bottom-0">
    <!-- <button
      type="button"
      id="add-product-row"
      class="btn btn-icon btn-outline-success btn-lg"
      data-original-title="Add"
    >
      <i onclick="add_another_product()" class="fa fa-plus"></i>
    </button>-->

    <div id="example-1">
      <button
        v-on:click="update"
        class="btn btn-icon btn-outline-success btn-lg"
        type="button"
      >Add 1</button>
    </div>
  </td>
</template>
<script>
export default {
  methods: {
    update(val) {
      console.log(val);
      //this.$emit("update", this.id, val.target.selectedOptions[0].value);
    },
    del() {
      this.$emit("delete", this.id);
    },
  },
};
</script>