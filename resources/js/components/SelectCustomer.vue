<template>
    <div class="form-group col required">
        <label class="form-control-label">Select Customer<span>*</span></label>

        <div class="input-group input-group-merge dropdown">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa fa-user"></i>
                </span>
            </div>
            <v-select
                class="form-control"
                :options="customers"
                label="name_phone"
                @input="selected"
                @search="fetchcustomers"
            >
            </v-select>
        </div>
    </div>
</template>
<script>
import vSelect from "vue-select";
import "vue-select/src/scss/vue-select.scss";
export default {
    components: {
        "v-select": vSelect
    },
    data() {
        return {
            options: ["a", "b", "c"],
            inputValue: "",
            customers: [],
            apiLoaded: false,
            apiUrl: "/invoice-create-name"
        };
    },

    methods: {
        itemVisible(item) {
            let currentName = item.phone;
            let currentInput = this.inputValue;
            return currentName.includes(currentInput);
        },
        fetchcustomers(value) {
            let that = this;
            axios.get(this.apiUrl, "search=" + value).then(resp => {
                let unique_data = resp.data.data.filter(function(obj) {
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
        },
        selected(value) {
            console.log(value);
        },
        searched(value) {
            console.log(value);
        }
    }
};
</script>
