<template>
  <div id="app">
    <div class="heading">
      <h1>Cruds</h1>
    </div>
    <crud-component
      v-for="crud in cruds"
      v-bind="crud"
      :key="crud.id"
      @update="update"
      @delete="del"
    ></crud-component>
    <div>
      <button @click="create">Add</button>
    </div>
  </div>
</template>
<script>
function Crud({ id, color, name }) {
  this.id = id;
  this.color = color;
  this.name = name;
}

import CrudComponent from "./components/CrudComponent.vue";

export default {
  data() {
    return {
      cruds: [],
    };
  },
  methods: {
    async create() {
      // To do
    },
    async read() {
      // To do
    },
    async update(id, color) {
      // To do
    },
    async del(id) {
      // To do
    },
  },
  components: {
    CrudComponent,
  },
};
</script>