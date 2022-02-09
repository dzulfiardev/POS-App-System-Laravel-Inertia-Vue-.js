<template>
  <div class="container my-5">
    <SuccessNotification :message="message.success" />
    <div class="md:grid md:grid-cols-3 md:gap-6">
      <!--  -->
      <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-1">
          <div class="mt-5 md:mt-0 md:col-span-3">
            <form @submit.prevent="submit">
              <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                  <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-6">
                      <label
                        for="code"
                        class="block text-sm font-medium text-gray-700"
                        >Code</label
                      >
                      <input
                        type="text"
                        name="code"
                        id="code"
                        autocomplete="off"
                        class="
                          mt-1
                          focus:ring-indigo-500 focus:border-indigo-500
                          block
                          w-full
                          shadow-sm
                          sm:text-sm
                          border-gray-300
                          rounded-md
                        "
                        placeholder="0"
                        autofocus
                        v-model="form.brand_code"
                      />
                      <small
                        class="text-red-600"
                        v-if="validation.brand_code"
                        >{{ validation.brand_code }}</small
                      >
                      <small class="text-red-600" v-if="validation.number">{{
                        validation.number
                      }}</small>
                    </div>
                  </div>
                  <div class="grid grid-cols-6 gap-6 mt-2">
                    <div class="col-span-6 sm:col-span-6">
                      <label
                        for="name"
                        class="block text-sm font-medium text-gray-700"
                        >Name</label
                      >
                      <input
                        type="text"
                        name="name"
                        id="name"
                        autocomplete="off"
                        class="
                          mt-1
                          focus:ring-indigo-500 focus:border-indigo-500
                          block
                          w-full
                          shadow-sm
                          sm:text-sm
                          border-gray-300
                          rounded-md
                        "
                        v-model="form.brand_name"
                      />
                      <small
                        class="text-red-600"
                        v-if="validation.brand_name"
                        >{{ validation.brand_name }}</small
                      >
                    </div>
                  </div>
                </div>

                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                  <button
                    type="button"
                    class="
                      inline-flex
                      justify-center
                      py-2
                      px-4
                      mx-1
                      border border-transparent
                      shadow-sm
                      text-sm
                      font-medium
                      rounded-md
                      text-white
                      bg-stone-700
                      hover:bg-stone-800
                      focus:outline-none
                      focus:ring-2
                      focus:ring-offset-2
                      focus:ring-stone-600
                    "
                    :class="{ 'opacity-25': disable.save }"
                    :disabled="disable.save"
                    v-if="action.cancelUpdate"
                    @click="resetForm()"
                  >
                    Cancel
                  </button>

                  <button
                    type="submit"
                    class="
                      inline-flex
                      justify-center
                      py-2
                      px-4
                      border border-transparent
                      shadow-sm
                      text-sm
                      font-medium
                      rounded-md
                      text-white
                      bg-indigo-600
                      hover:bg-indigo-700
                      focus:outline-none
                      focus:ring-2
                      focus:ring-offset-2
                      focus:ring-indigo-500
                    "
                    :class="{ 'opacity-25': disable.save }"
                    :disabled="disable.save"
                  >
                    Save
                  </button>

                  <!-- <progress
                    v-if="form.progress"
                    :value="form.progress.percentage"
                    max="100"
                  >
                    {{ form.progress.percentage }}%
                  </progress> -->
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Separator -->

      <div class="mt-5 md:mt-0 md:col-span-2">
        <div class="shadow sm:rounded-md sm:overflow-hidden">
          <div class="px-4 py-2 bg-white space-y-6 sm:p-6">
            <DataTable
              :tableHead="tableHead"
              :dataList="data"
              :links="data.pagination"
              :params="params"
              :path="path"
              :loader="loader"
              :allDataTablePath="path.allDataTable"
              @dataTable="dataTable"
              @edit="edit"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { reactive, onMounted } from "vue";
import NProgress from "nprogress";
import SuccessNotification from "./SuccessNotification.vue";
import DataTable from "./DataTable.vue";

export default {
  components: {
    SuccessNotification,
    DataTable,
  },
  setup() {
    const form = reactive({
      id: null,
      brand_code: null,
      brand_name: null,
    });

    const params = reactive({
      search: "",
      page: "",
      field: "",
      direction: "",
    });

    const loader = reactive({
      table: false,
    });

    const action = reactive({
      cancelUpdate: false,
      id: 0,
    });

    const tableHead = reactive({
      checkboxAll: true,
      th: [
        {
          name: "Code",
          sort: true,
          sortName: "brand_code",
        },
        {
          name: "Brand Name",
          sort: true,
          sortName: "brand_name",
        },
        {
          name: "Action",
          sort: false,
          sortName: null,
        },
      ],
    });

    const data = reactive({
      table: {},
      pagination: [],
    });

    const validation = reactive({
      number: "",
      brand_code: null,
      brand_name: null,
    });

    const message = reactive({
      success: null,
    });

    const disable = reactive({
      save: false,
    });

    const path = reactive({
      allDataTable: "brand-all",
      destroy: "brand",
      bulkDestroy: "brand-bulk-delete",
      filter: "filter",
    });

    function dataTable() {
      loader.table = true;
      axios
        .get("/brand-all")
        .then((res) => {
          loader.table = false;
          data.table = res.data.success.data;
          data.pagination = res.data.success.links;
        })
        .catch((err) => {
          loader.table = false;
          console.log(err.response);
        });
    }

    function resetForm() {
      form.id = null;
      form.brand_code = null;
      form.brand_name = null;
      validation.number = "";
      validation.brand_code = null;
      validation.brand_name = null;
      action.cancelUpdate = false;
    }

    function edit(id) {
      NProgress.start();
      axios
        .get("/brand/" + id)
        .then((res) => {
          action.cancelUpdate = true;
          NProgress.done();
          const data = res.data.success;
          form.id = data.id;
          form.brand_code = data.brand_code;
          form.brand_name = data.brand_name;
        })
        .catch((err) => {
          console.log(err.response);
        });
    }

    function submit() {
      NProgress.start();
      disable.save = true;

      if (!/^[0-9]+$/.test(form.brand_code)) {
        NProgress.done();
        disable.save = false;
        validation.number =
          "Please only enter numeric characters only for Category Code";
        return false;
      } else {
        validation.number = "";
      }

      axios
        .post("/brand", form)
        .then((res) => {
          NProgress.done();
          resetForm();
          dataTable();
          disable.save = false;
          message.success = res.data.success;
          window.scrollTo({
            top: 0,
            behavior: "smooth",
          });
          setTimeout(() => {
            message.success = null;
          }, 3000);
        })
        .catch((err) => {
          const error = err.response.data.error;
          NProgress.done();
          disable.save = false;
          if (error) {
            if (error.brand_code) {
              validation.brand_code = error.brand_code[0];
            } else {
              validation.brand_code = null;
            }

            if (error.brand_name) {
              validation.brand_name = error.brand_name[0];
            } else {
              validation.brand_name = null;
            }
          }
        });
    }

    onMounted(() => {
      dataTable();
    });

    return {
      params,
      action,
      data,
      form,
      validation,
      disable,
      message,
      path,
      tableHead,
      loader,
      dataTable,
      submit,
      edit,
      resetForm,
    };
  },
};
</script>

<style>
</style>