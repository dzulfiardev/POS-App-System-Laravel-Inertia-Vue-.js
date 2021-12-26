<template>
  <div class="container my-5">
    <div class="md:grid md:grid-cols-3 md:gap-6">
      <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-1">
          <div class="mt-5 md:mt-0 md:col-span-3">
            <form action="#" method="POST">
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
                        autocomplete="given-name"
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
                      />
                    </div>
                  </div>
                  <div class="grid grid-cols-6 gap-6 mt-2">
                    <div class="col-span-6 sm:col-span-6">
                      <label
                        for="first-name"
                        class="block text-sm font-medium text-gray-700"
                        >Name</label
                      >
                      <input
                        type="text"
                        name="first-name"
                        id="first-name"
                        autocomplete="given-name"
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
                      />
                    </div>
                  </div>
                </div>

                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
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
                  >
                    Save
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Sparator -->

      <div class="mt-5 md:mt-0 md:col-span-2">
        <div class="shadow sm:rounded-md sm:overflow-hidden">
          <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
            <DataTable :head="tableHead" :data="categories" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// import { defineComponent } from "@vue/composition-api";
import DataTable from "../DataTable/DataTable.vue";

export default {
  components: {
    DataTable,
  },
  data() {
    return {
      tableHead,
      categories,
    };
  },
};

const tableHead = [
  {
    title: "Code",
  },
  {
    title: "Category Name",
  },
  {
    title: "Action",
  },
];

const categories = [
  {
    id: "1",
    code: "001",
    name: "Food",
  },
  {
    id: "2",
    code: "002",
    name: "Grocery",
  },
  {
    id: "3",
    code: "003",
    name: "Non Food",
  },
  {
    id: "4",
    code: "004",
    name: "Beverage",
  },
  {
    id: "4",
    code: "004",
    name: "Beverage",
  },
  {
    id: "4",
    code: "004",
    name: "Beverage",
  },
  {
    id: "4",
    code: "004",
    name: "Beverage",
  },
  {
    id: "4",
    code: "004",
    name: "Beverage",
  },
  {
    id: "4",
    code: "004",
    name: "Beverage",
  },
  {
    id: "4",
    code: "004",
    name: "Beverage",
  },
  {
    id: "4",
    code: "004",
    name: "Beverage",
  },
  {
    id: "4",
    code: "004",
    name: "Beverage",
  },
  {
    id: "4",
    code: "004",
    name: "Beverage",
  },
  {
    id: "4",
    code: "004",
    name: "Beverage",
  },
  {
    id: "4",
    code: "004",
    name: "Beverage",
  },
  {
    id: "4",
    code: "004",
    name: "Beverage",
  },
  {
    id: "4",
    code: "004",
    name: "Beverage",
  },
  {
    id: "4",
    code: "004",
    name: "Beverage",
  },
  {
    id: "4",
    code: "004",
    name: "Beverage",
  },
  {
    id: "4",
    code: "004",
    name: "Beverage",
  },
  {
    id: "4",
    code: "004",
    name: "Beverage",
  },
  {
    id: "4",
    code: "004",
    name: "Beverage",
  },
  {
    id: "4",
    code: "004",
    name: "Beverage",
  },
  {
    id: "4",
    code: "004",
    name: "Beverage",
  },
  {
    id: "4",
    code: "004",
    name: "Beverage",
  },
  {
    id: "4",
    code: "004",
    name: "Beverage",
  },
  {
    id: "4",
    code: "004",
    name: "Beverage",
  },
  {
    id: "4",
    code: "004",
    name: "Beverage",
  },
  {
    id: "4",
    code: "004",
    name: "Beverage",
  },
  {
    id: "4",
    code: "004",
    name: "Beverage",
  },
  {
    id: "4",
    code: "004",
    name: "Beverage",
  },
  {
    id: "4",
    code: "004",
    name: "Beverage",
  },
  {
    id: "4",
    code: "004",
    name: "Beverage",
  },
  {
    id: "4",
    code: "004",
    name: "Beverage",
  },
  {
    id: "4",
    code: "004",
    name: "Beverage",
  },
  {
    id: "4",
    code: "004",
    name: "Beverage",
  },
  {
    id: "4",
    code: "004",
    name: "Beverage",
  },
];
</script>
