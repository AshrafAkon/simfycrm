require("./bootstrap");
window.Vue = require("vue");

//import Articles from "./components/Articles.vue";
//import AddButton from "./components/AddButton.vue";

import Expense from "./components/Expense.vue";
Vue.component("expense", Expense);

// components: {
//   App,
// },
const app = new Vue({
    el: "#add_expense",
    data: {
        counter: 0
    }
});

