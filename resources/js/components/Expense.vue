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
        <div id="add_button">
          <!-- <select-customer></select-customer> -->
          <div class="panel-body" id="app">
            <div class="row">
              <div class="form-group col required">
                <label for="courier" class="form-control-label">Date</label>
                <div class="input-group input-group-merge">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fa fa-clock"></i>
                    </span>
                    <date-picker class="from-control" v-model="date" value-type="format"></date-picker>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="form-group col required">
                <label for="courier" class="form-control-label">Name</label>
                <div class="input-group input-group-merge">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fa fa-clock"></i>
                    </span>
                    <input
                      class="form-control"
                      type="text"
                      v-model="name"
                      placeholder="Enter Expense Name"
                    />
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="form-group col required">
                <label for="courier" class="form-control-label">Description</label>
                <div class="input-group input-group-merge">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fa fa-clock"></i>
                    </span>
                    <textarea
                      type="text"
                      class="from-control"
                      v-model="description"
                      placeholder="Enter Description"
                    />
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6 required">
                <label for="courier" class="form-control-label">Amount</label>
                <div class="input-group input-group-merge">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fa fa-clock"></i>
                    </span>
                    <input class="from-control" v-model="amount" value-type="format" />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="text-center">
            <button class="btn btn-primary" @click="save">Save</button>
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
  props: ["save_url"],
  data() {
    return {
      date: new Date().toJSON().slice(0, 10),
      name: null,
      amount: null,
      description: null,
    };
  },

  methods: {
    save() {
      document.getElementById("overlay").style.display = "block";
      axios({
        method: "post",
        url: this.save_url,
        data: {
          name: this.name,
          amount: this.amount,
          description: this.description,
          date: this.date,
        },
      }).then((resp) => {
        console.log(resp);
        // goiing to edit page
        window.location.href = resp.data;
      });
    },
    searched(value) {
      console.log(value);
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
