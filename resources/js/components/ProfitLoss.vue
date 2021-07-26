<template>
    <div>
        <div class="row">
                <p v-if="errors.length">
                    <b>Please correct the following error(s):</b>
                    <ul>
                        <li class="text-danger" v-for="error in errors" :key="error">{{ error }}</li>
                    </ul>
                </p>

        </div>
        <div class="row border-none">

            <div class="col-4">
                <h4>Start Date</h4>
                <date-picker
                    class="from-control m-auto"
                    v-model="start_date"
                    value-type="format"
                    v-on:change="date_changed"
                ></date-picker>
            </div>
            <div class="col-4">
                <h4>End Date</h4>
                <date-picker
                    class="from-control m-auto"
                    v-model="end_date"
                    value-type="format"
                    v-on:change="date_changed"
                ></date-picker>
            </div>
            <div class="col-4 d-flex flex-column justify-content-center">
                <button
                    v-on:click="fetchInvoices"
                    class="btn btn-success m-auto"
                >
                    View Reports
                </button>
            </div>
        </div>
        <table class="table table-striped mt-3">
            <!-- <thead>
                <tr>
                    <th scope="col">Product Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                </tr>
            </thead> -->
            <tbody>
                <!-- <tr v-for="product in reported_products" :key="product.id">
                    <th scope="row">{{ product.id }}</th>
                    <td>{{ product.name }}</td>
                    <td>{{ product.quantity }}</td>
                    <td>{{ product.selling_price }}</td>
                </tr>
                <tr>
                    <td></td>
                </tr> -->
                <tr>
                    <td></td>
                    <td>Total Selling Price:</td>
                    <td></td>
                    <td>{{ total_price }} bdt</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Total Buying Price:</td>
                    <td></td>
                    <td>{{ total_buy }} bdt</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Profit/Loss</td>
                    <td></td>
                    <td>{{ total_price - total_buy}} bdt</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import DatePicker from "vue2-datepicker";
import "vue2-datepicker/index.css";
export default {
  components: { DatePicker },
  computed: {
    products() {
      return [];
    },
    total_price() {
      var t = 0;
      for (var i = 0; i < this.reported_products.length; i++) {
        t += parseInt(this.reported_products[i].selling_price);
      }
      return t;
    },
    total_buy() {
      var t = 0;
      for (var i = 0; i < this.reported_products.length; i++) {
        t += parseInt(this.reported_products[i].price);
      }
      return t;
    },
    total_() {
      let t = 0;
      this.reported_products.forEach((prod) => {
        t += parseInt(prod);
      });
    },
  },
  data: function () {
    return {
      start_date: null,
      end_date: null,
      fetched_invocies: null,
      reported_products: [],
      errors: [],
      total_selling_price: 0,
      total_buying_price: 0,
    };
  },
  mounted() {
    this.start_date = localStorage.getItem("start_date");
    this.end_date = localStorage.getItem("end_date");
  },
  methods: {
    date_changed() {
      console.log("date.changed");
      localStorage.setItem("end_date", this.end_date);
      localStorage.setItem("start_date", this.start_date);
    },
    fetchInvoices() {
      this.errors = [];

      if (this.start_date == null) {
        this.errors.push("Please select a start date.");
      }
      if (this.end_date == null) {
        this.errors.push("Please select an end date.");
      }

      if (this.errors.length == 0) {
        this.reported_products = [];
        axios({
          method: "post",
          url: "/reports/findwithdate",
          data: {
            start_date: this.start_date,
            end_date: this.end_date,
            errors: [],
          },
        }).then((resp) => {
          console.log(resp.data.length);
          for (var k = 0; k < resp.data.length; k++) {
            for (var i = 0; i < resp.data[k].records.length; i++) {
              var found = false;
              console.log("record ", resp.data[k].records[i]);
              for (var j = 0; j < this.reported_products.length; j++) {
                //console.log(resp.data[k].records[i].id);
                console.log(this.reported_products[j].id);
                if (
                  resp.data[k].records[i].products_id ==
                  this.reported_products[j].products_id
                ) {
                  this.reported_products[j].selling_price = parseInt(
                    this.reported_products[j].selling_price
                  );
                  this.reported_products[j].quantity = parseInt(
                    this.reported_products[j].quantity
                  );

                  found = true;
                  this.reported_products[j].quantity += parseInt(
                    resp.data[k].records[i].quantity
                  );
                  this.reported_products[j].selling_price += parseInt(
                    resp.data[k].records[i].selling_price
                  );
                  break;
                }
              }
              if (!found) {
                this.reported_products.push(resp.data[k].records[i]);
              }
              console.log(this.reported_products);
            }
          }
        });
      }
    },
  },
};
</script>
