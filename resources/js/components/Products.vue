<template>
    <div>
        <div id="overlay">
            <!-- <div class="spinner-border-lg text-success" role="status">
        <span class="sr-only">Loading...</span>
      </div>-->
            <div class="loading">
                <div class="loader"></div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <p v-if="errors.length">
                    <b>Please correct the following error(s):</b>
                    <ul>
                        <li class="text-danger" v-for="error in errors" :key="error">{{ error }}</li>
                    </ul>
                </p>

            </div>
            <div class="row">
                <div class="col" v-if="invoice_id">
                    <a
                        :href="'/invoices-print/' + invoice_id"
                        target="_blank"
                        class="btn btn-primary float-right"
                        >Print</a
                    >
                    <button
                        v-if="this.total_amount != this.payment"
                        @click="markAsPaid"
                        class="btn btn-success float-right mr-3"
                    >
                        Mark as Paid
                    </button>
                    <button
                        v-else
                        @click="markAsPaid"
                        class="btn btn-success float-right mr-3"
                    >
                        Mark as Unpaid
                    </button>
                </div>
                <div id="add_button">
                    <!-- <select-customer></select-customer> -->
                    <div class="panel-body" id="app">
                        <div class="form-group required">
                            <label class="form-control-label">
                                Select Customer
                                <span>*</span>
                            </label>

                            <div class="input-group input-group-merge dropdown">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <v-select
                                    class="form-control"
                                    :options="customers"
                                    v-model="customer"
                                    label="name_phone"
                                    @input="selected"
                                    @search="fetchcustomers"
                                ></v-select>
                            </div>
                        </div>

                        <div class="row">
                            <div
                                class="form-group col-md-6 required"
                                v-if="invoice_id"
                            >
                                <label
                                    for="invoice_number"
                                    class="form-control-label"
                                    >Invoice Number</label
                                >
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-file"></i>
                                        </span>
                                    </div>
                                    <input
                                        class="form-control"
                                        data-name="invoice_number"
                                        placeholder="Enter Invoice Number"
                                        required="required"
                                        name="invoice_number"
                                        type="text"
                                        :value="invoice_id"
                                        id="invoice_number"
                                        disabled
                                    />
                                </div>
                            </div>
                            <div class="form-group col-md-6 required">
                                <label for="courier" class="form-control-label"
                                    >Courier</label
                                >
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-truck"></i>
                                        </span>
                                        <select
                                            class="form-control"
                                            @change="onCourierChange($event)"
                                            v-model="courier_id"
                                            required
                                        >

                                            <option
                                                :value="courier.id"
                                                v-for="courier in couriers"
                                                :key="courier.id"
                                            >
                                                {{ courier.name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-6 required">
                                <label for="courier" class="form-control-label"
                                    >Date</label
                                >
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-clock"></i>
                                        </span>
                                        <date-picker
                                            class="from-control"
                                            v-model="date"
                                            value-type="format"
                                        ></date-picker>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6 required">
                                <label for="courier" class="form-control-label"
                                    >Status</label
                                >
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-truck"></i>
                                        </span>
                                        <select
                                            class="form-control"
                                            v-model="invoicestatus_id"
                                            @change="onChangeStatus($event)"
                                        >
                                            <option
                                                v-for="status in invoicestatuses"
                                                :key="status.id"
                                                :value="status.id"
                                            >
                                                {{ status.status }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <table class="table table-bordered" id="items">
                            <thead class="thead-light">
                                <tr class="d-flex">
                                    <th class="text-center col-1">No.</th>

                                    <th class="text-center col-1.5">Actions</th>

                                    <th class="text-left col-7">Name</th>

                                    <th class="text-center col-2">Quantity</th>

                                    <th class="text-right col-2">Rate</th>

                                    <th class="text-right col-2">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    class="d-flex"
                                    v-for="(row, index) in rows"
                                    :key="row.index"
                                >
                                    <td class="col-1">{{ index + 1 }}</td>

                                    <td
                                        class="text-center border-right-0 border-bottom-0 col-1.5"
                                    >
                                        <button
                                            type="button"
                                            @click="removeRow(index)"
                                            data-toggle="tooltip"
                                            title="Delete"
                                            class="btn btn-icon btn-outline-danger btn-lg"
                                        >
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                    <td class="col-7" style="width: 5em">
                                        <v-select
                                            :options="products"
                                            label="name"
                                            v-model="row.product"
                                            @input="onProductChange(index)"
                                            persistent-hint
                                            return-object
                                            single-line
                                        ></v-select>
                                    </td>
                                    <td
                                        class="border-right-0 border-bottom-0 w-10 col-2"
                                    >
                                        <input
                                            type="text"
                                            class="form-control text-center"
                                            autocomplete="off"
                                            required="required"
                                            data-item="quantity"
                                            v-model="row.quantity"
                                            @input="updatePrice(index)"
                                        />
                                    </td>

                                    <td
                                        class="border-right-0 border-bottom-0 pb-0 col-2"
                                    >
                                        <input
                                            type="text"
                                            class="form-control text-center"
                                            data-item="selling_price"
                                            required="required"
                                            v-model="row.selling_price"
                                            @input="productTotal(index)"
                                        />
                                    </td>
                                    <td
                                        class="border-right-0 border-bottom-0 pb-0 col-2"
                                    >
                                        <input
                                            type="text"
                                            class="form-control text-center"
                                            data-item="price"
                                            v-model="row.price"
                                            required="required"
                                            disabled
                                        />
                                    </td>
                                </tr>
                                <tr class="d-flex">
                                    <td class="col-1"></td>
                                    <td
                                        class="text-center border-right-0 border-bottom-0 col-1.5"
                                    >
                                        <button
                                            type="button"
                                            @click="addRow()"
                                            data-toggle="tooltip"
                                            title="Delete"
                                            class="btn btn-icon btn-outline-danger btn-lg"
                                        >
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr id="tr-subtotal">
                                    <td
                                        class="text-right border-right-0 border-bottom-0"
                                        colspan="5"
                                    >
                                        <strong>Subtotal</strong>
                                    </td>
                                    <td
                                        class="text-right border-bottom-0 long-texts"
                                    >
                                        <span>{{ subtotal }}</span>
                                    </td>
                                </tr>

                                <tr id="tr-discount">
                                    <td
                                        class="text-right border-right-0 border-bottom-0"
                                        colspan="5"
                                    >
                                        <strong>Add discount(%)</strong>
                                    </td>
                                    <td
                                        class="text-right border-bottom-0 long-texts"
                                    >
                                        <input
                                            type="text"
                                            v-model="discount"
                                            class="form-control text-right"
                                            number
                                        />
                                    </td>
                                </tr>
                                <tr id="tr-payment">
                                    <td
                                        class="text-right border-right-0 border-bottom-0"
                                        colspan="5"
                                    >
                                        <strong>Add Payments</strong>
                                    </td>
                                    <td
                                        class="text-right border-bottom-0 long-texts"
                                    >
                                        <input
                                            type="text"
                                            v-model="payment"
                                            class="form-control text-right"
                                            number
                                        />
                                    </td>
                                </tr>

                                <tr id="tr-courier-charge">
                                    <td
                                        class="text-right border-right-0 border-bottom-0"
                                        colspan="5"
                                    >
                                        <strong>Courier Charge</strong>
                                    </td>
                                    <td
                                        class="text-right border-bottom-0 long-texts"
                                    >
                                        <span>{{ courier_charge }}</span>
                                    </td>
                                </tr>

                                <tr id="tr-total">
                                    <td
                                        class="text-right border-right-0"
                                        colspan="5"
                                    >
                                        <strong>Total</strong>
                                    </td>
                                    <td class="text-right long-texts">
                                        <span>{{ total }}</span>
                                    </td>
                                </tr>
                                <tr id="tr-total" v-if="payment">
                                    <td
                                        class="text-right border-right-0"
                                        colspan="5"
                                    >
                                        <strong>Remaning</strong>
                                    </td>
                                    <td class="text-right long-texts">
                                        <span>{{ total - payment }}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group col-md-6">
                            <label for="notes" class="form-control-label"
                                >Notes</label
                            >

                            <textarea
                                class="form-control"
                                data-name="notes"
                                placeholder="Enter Notes"
                                rows="3"
                                name="notes"
                                cols="50"
                                id="notes"
                                v-model="notes"
                            ></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="row save-buttons">
                <div class="col-md-12 text-center">
                    <button
                        v-if="!isCompleted"
                        @click="save"
                        class="btn-lg btn-success"
                    >
                        {{ invoice_id ? "Update Invoice" : "Save Invoice" }}
                    </button>
                </div>
            </div>
        </div>
        <div
            class="modal fade"
            id="NotEnoughProduct"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            Not Enough Product
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Not enough product in inventory. Please restock.
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import vSelect from "vue-select";
import DatePicker from "vue2-datepicker";
import "vue2-datepicker/index.css";
export default {
    components: { "v-select": vSelect, DatePicker },
    props: ["invoice_id", "delete", "csrf_token"],
    data() {
        return {
            date: new Date().toJSON().slice(0, 10),
            rows: [
                //initial data
                //{ id: 1, qty: 5, name: "Something", selling_price: 55.2,quantity:50, tax: 10 },
                {},
            ],
            tem: 1,
            couriers: [
                // { id: "", name: "Select courier" },
                // { id: "", name: "hello" }
            ],
            selectedCustomer: {},
            courier_id: null,
            courier_charge: 0,
            courier: {},
            products: [],
            index: 0,
            grandtotal: 0,
            delivery: 40,
            change: false,
            options: ["a", "b", "c"],
            inputValue: "",
            customers: [],
            customer: null,
            apiLoaded: false,
            discount: 0,
            total_amount: 0,
            apiUrl: "/search-customer-with-phone",
            subtotal: 0,
            payment: 0,
            invoicestatus_id: 1,
            notes: "",
            row_index: 1,
            invoicestatuses: {},
            product: null,
            isCompleted: false,
            errors: [],
        };
    },
    mounted() {
        console.log(this.invoice_id);
    },
    computed: {
        total: function () {
            var t = 0;
            $.each(this.rows, function (i, e) {
                if (typeof e.price !== "undefined") {
                    t += e.price;
                }
            });
            this.subtotal = t;
            if (this.discount > 0) {
                this.total_amount = Math.floor(t - (t * this.discount) / 100);
            } else {
                this.total_amount = Math.floor(t);
            }
            this.total_amount = this.total_amount + this.courier_charge;
            //this.subtotal = this.subtotal + this.courier_charge;
            console.log("pao####################", this.total_amount);
            return this.total_amount;
        },
        taxtotal: function () {
            var tt = 0;
            $.each(this.rows, function (i, e) {
                tt += accounting.unformat(e.tax_amount, ",");
            });
            return tt;
        },
    },
    created() {
        console.log(this.date);
        this.getCourierlist();
        this.getInvoiceStatuses();
        this.getProductslist();

        this.fetchlastcustomers();
        console.log("invoice id: ", this.invoice_id);
        if (this.invoice_id) {
            console.log("invoice id valid");
            // if invoice id is present that means edit
            axios({
                method: "post",
                url: "/invoices-find-single",
                data: {
                    invoice_id: this.invoice_id,
                },
            }).then((resp) => {
                console.log("respp: ", resp);
                //this.courier = resp.data.courier;
                //this.couriers.push(resp.data.courier);
                console.log("courR:", this.couriers);
                for (let i = 0; i < this.couriers.length; i++) {
                    // if other new courier info is there
                    console.log("rsp cou id: ", resp.data.courier.id);
                    //console.log(typeof this.couriers[i].id);
                    //console.log(typeof resp.data.courier.id);
                    this.courier_id = resp.data.courier.id;
                    let temp_customer = { ...resp.data.customer };
                    // showing the ccolor with the name in select box
                    temp_customer.name_phone =
                        temp_customer.name + " - " + temp_customer.phone;
                    this.customer = temp_customer;
                    console.log(this.customer);
                    this.rows = [];
                    // setting courier
                    this.courier = resp.data.courier;
                    this.courier_charge = this.courier.charge;
                    this.date = resp.data.date;
                    this.payment = resp.data.payment;
                    this.discount = resp.data.discount;
                    this.invoicestatus_id = resp.data.invoicestatus_id;
                    console.log(resp.data);
                    this.isCompleted = resp.data.isCompleted;
                    //print("id: ", this.invoicestatus_id);

                    this.notes = resp.data.notes;
                    // setting product rows
                    //this.rows = resp.data.rows;
                    for (let i = 0; i < resp.data.rows.length; i++) {
                        let _temp = resp.data.rows[i];
                        _temp.id = _temp.products_id;
                        for (let x = 0; x < this.products.length; x++) {
                            if (this.products[x].id == _temp.id) {
                                // product and row prodcut is same
                                // adding maximum quanity
                                _temp.maximum =
                                    this.products[i].quantity + _temp.quantity;
                                break;
                            }
                        }
                        console.log(_temp);
                        _temp.product = { ..._temp };
                        this.rows.push(_temp);
                    }
                    // updating the row_index. so when click on
                    // add row butotn it wil lappend the row after the last available row
                    this.row_index = resp.data.rows.length;
                    //console.log("rooooooooows", this.rows);
                }
            });
        }
    },
    methods: {
        markAsPaid() {
            if (this.payment != this.total_amount) {
                this.payment = this.total_amount;
            } else {
                this.payment = 0;
            }
        },
        productTotal: function (index) {
            console.log(index);
            console.log(this.rows[index].selling_price);
            let _temp = this.rows[index];

            _temp.price =
                this.rows[index].quantity * this.rows[index].selling_price;
            Vue.set(this.rows, index, _temp);
        },
        onDateChange(event) {
            console.log(event);
        },
        onChangeStatus(event) {
            console.log(this.invoicestatus_id);
            console.log(event);
        },
        getInvoiceStatuses: function () {
            axios.post("/invoicestatus").then((resp) => {
                this.invoicestatuses = resp.data;
                console.log(this.invoicestatuses);
            });
        },
        getCourierlist: function () {
            axios.get("/couriers-list").then((resp) => {
                //console.log("courier list at get:", resp.data);
                //console.log(this.couriers);
                //this.couriers = resp.data;
                for (let i = 0; i < resp.data.length; i++) {
                    this.couriers.push(resp.data[i]);
                }
                //Vue.set(this.couriers, 1, resp.data);
                //console.log(this.couriers);
            });
        },
        addRow: function () {
            try {
                this.rows.splice(this.row_index + 1, 0, {});
                this.row_index++;
            } catch (e) {
                console.log(e);
            }
        },
        removeRow: function (index) {
            this.rows.splice(index, 1);
            this.row_index--;
        },
        onCourierChange: function (event) {
            console.log(event);
            for (let i = 0; i < this.couriers.length; i++) {
                if (this.couriers[i].id == this.courier_id) {
                    this.courier = this.couriers[i];
                    this.courier_charge = this.courier.charge;
                }
            }
            console.log(this.courier);
            console.log("id chage: ", this.courier_id);
            //console.log(this.couriers[index]);
        },
        onProductChange: function (index) {
            console.log("index:", this.rows[index]);
            console.log(this.rows);
            console.log(this.products);
            for (let i = 0; i < this.products.length; i++) {
                if (this.products[i].id == this.rows[index].product.id) {
                    //console.log(this.products[i].name);
                    console.log(this.rows);
                    this.rows[index].id = this.rows[index].product.id;
                    this.rows[index].name = this.products[i].name;
                    this.rows[index].price = this.products[i].selling_price;
                    this.rows[index].selling_price =
                        this.products[i].selling_price;
                    // setting initial quantity to 1
                    this.rows[index].quantity = 1;
                    this.rows[index].maximum = this.products[i].quantity;
                    console.log(this.rows);
                }
            }
            console.log("row: ", this.rows[index]);
            //console.log(e.target.parentElement);
            //console.log(this.rows);
        },
        getProductslist: function () {
            axios.get("/products-list").then((resp) => {
                console.log(resp.data);
                this.products = resp.data;
            });
        },
        updatePrice: function (index) {
            console.log(this.rows[index]);
            if (this.rows[index].quantity > this.rows[index].maximum) {
                console.log("not enough products");
                $("#NotEnoughProduct").modal("show");
                let temp = this.rows[index];
                temp.quantity = 1;
                temp.price = temp.quantity * temp.selling_price;
                Vue.set(this.rows, index, temp);
                return;
            }
            console.log("updating");
            let temp = this.rows[index];

            temp.price =
                this.rows[index].quantity * this.rows[index].selling_price;

            Vue.set(this.rows, index, temp);
            console.log(this.courier_charge);
        },
        fetchlastcustomers() {
            let that = this;

            axios.get("/fetch-last-customer").then((resp) => {
                console.log(resp);
                // let unique_data = resp.data.data.filter(function (obj) {
                //   //console.log('yo');
                //   for (let i = 0; i < that.customers.length; i++) {
                //     if (that.customers[i].id == obj.id) {
                //       return false;
                //     }
                //   }
                //   return true;
                // });

                console.log(resp.data);
                let unique_data = resp.data;
                for (let i = 0; i < unique_data.length; i++) {
                    unique_data[i].name_phone =
                        unique_data[i].name + " - " + unique_data[i].phone;
                }
                this.customers.push(...unique_data);
                // console.log(this.customers);
                // console.log(unique_data);
            });
        },
        fetchcustomers(value) {
            let that = this;

            if (value.length >= 3) {
                axios.get(this.apiUrl, "search=" + value).then((resp) => {
                    console.log(resp);

                    let unique_data = resp.data.filter(function (obj) {
                        //console.log('yo');
                        for (let i = 0; i < that.customers.length; i++) {
                            if (that.customers[i].id == obj.id) {
                                return false;
                            }
                        }
                        return true;
                    });
                    for (let i = 0; i < unique_data.length; i++) {
                        unique_data[i].name_phone =
                            unique_data[i].name + " - " + unique_data[i].phone;
                    }
                    this.customers.push(...unique_data);
                    // console.log(this.customers);
                    // console.log(unique_data);
                });
            }
        },
        selected(value) {
            console.log(value);
            this.customer = value;
        },
        save() {
            this.errors = [];

            if (this.customer == null) {
                this.errors.push("Please select a customer.");
            }
            if (this.courier_id == null) {
                this.errors.push("Please select a courier service.");
            }

            if (this.errors.length == 0) {
                document.getElementById("overlay").style.display = "block";
                axios({
                    method: this.invoice_id == "" ? "post" : "put",
                    url:
                        this.invoice_id == ""
                            ? "/invoices"
                            : "/invoices/" + this.invoice_id,
                    data: {
                        rows: this.rows,
                        customer_id: this.customer.id,
                        courier_id: this.courier.id,
                        invoice_id: this.invoice_id,
                        subtotal: this.subtotal,
                        amount: this.total_amount,
                        date: this.date,
                        payment: this.payment,
                        discount: this.discount,
                        invoicestatus_id: this.invoicestatus_id,
                        invoice_id: this.invoice_id,
                        notes: this.notes,
                        maximum: 1,
                    },
                }).then((resp) => {
                    console.log(resp);
                    // goiing to edit page//
                    window.location.href = resp.data; // + "?_token=" + this.csrf_token;
                });
            }
        },
        searched(value) {
            console.log(value);
        },
    },
    filters: {
        currencyDisplay: {
            // model -> view
            read: function (val) {
                if (val > 0) {
                    return val;
                }
            },
            // view -> model
            write: function (val, oldVal) {
                return val;
            },
        },
    },
};
</script>
<style>
#overlay {
    position: fixed;
    display: none;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 2;
    cursor: pointer;
}
.loading {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    /* background: #fff; */
}
.loader {
    left: 50%;
    margin-left: -4em;
    font-size: 10px;
    border: 0.8em solid rgba(218, 219, 223, 1);
    border-left: 0.8em solid rgba(58, 166, 165, 1);
    animation: spin 1.1s infinite linear;
}
.loader,
.loader:after {
    border-radius: 50%;
    width: 8em;
    height: 8em;
    display: block;
    position: absolute;
    top: 50%;
    margin-top: -4.05em;
}

@keyframes spin {
    0% {
        transform: rotate(360deg);
    }
    100% {
        transform: rotate(0deg);
    }
}
</style>
