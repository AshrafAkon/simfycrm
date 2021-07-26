require("./bootstrap");
window.Vue = require("vue");
window.axios = require('axios');


import ProfitLoss from "./components/ProfitLoss.vue";
Vue.component("profitloss", ProfitLoss);



// components: {
//   App,
// },
const app = new Vue({
    el: "#app",
    data: {
        counter: 0
    }
});
