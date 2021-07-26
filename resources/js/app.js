require("./bootstrap");
window.Vue = require("vue");
window.axios = require('axios');

//import Articles from "./components/Articles.vue";
//import AddButton from "./components/AddButton.vue";
import Products from "./components/Products.vue";
import Report from "./components/Report.vue";
import SelectCustomer from "./components/SelectCustomer.vue";
import Expense from "./components/Expense.vue";
Vue.component("products", Products);
Vue.component("report", Report);
Vue.component("select-customer", SelectCustomer);

Vue.component("expense", Expense);

// components: {
//   App,
// },
const app = new Vue({
    el: "#app",
    data: {
        counter: 0
    }
});
