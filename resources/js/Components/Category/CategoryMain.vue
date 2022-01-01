<template>
  <div class="container my-5">
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
                        v-model="form.category_code"
                      />
                      <small
                        class="text-red-600"
                        v-if="form.errors.category_code"
                        >{{ form.errors.category_code }}</small
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
                        v-model="form.category_name"
                      />
                      <small
                        class="text-red-600"
                        v-if="form.errors.category_name"
                        >{{ form.errors.category_name }}</small
                      >
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
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                  >
                    Save
                  </button>

                  <progress
                    v-if="form.progress"
                    :value="form.progress.percentage"
                    max="100"
                  >
                    {{ form.progress.percentage }}%
                  </progress>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Sparator -->

      <div class="mt-5 md:mt-0 md:col-span-2">
        <div class="shadow sm:rounded-md sm:overflow-hidden">
          <div class="px-4 py-2 bg-white space-y-6 sm:p-6">
            <div class="max-w-xs">
              <input
                type="search"
                v-model="params.search"
                aria-label="Search"
                placeholder="Search..."
                class="block w-full rounded-md border-gray-300 shadow-sm"
              />
            </div>
            <DataTable
              :head="tableHead"
              :values="data"
              :showEntries="showEntries"
              :currentEntries="currentEntries"
              :params="params"
              @sort="sort"
            />
            <Pagination class="mt-6" :links="data.links" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// import { defineComponent } from "@vue/composition-api";
import { reactive } from "vue";
import DataTable from "../DataTable/DataTable.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import Pagination from "../Pagination/Pagination";

export default {
  props: {
    errors: Object,
    data: Object,
  },
  components: {
    DataTable,
    Pagination,
  },
  data() {
    return {
      params: {
        search: null,
        field: null,
        direction: null,
      },
    };
  },
  methods: {
    sort(field) {
      this.params.field = field;
      this.params.direction = this.params.direction === "asc" ? "desc" : "asc";
    },
  },
  setup() {
    const form = useForm({
      id: null,
      category_code: null,
      category_name: null,
    });

    const validation = reactive({ number: "" });

    function submit() {
      if (!/^[0-9]+$/.test(form.category_code)) {
        validation.number =
          "Please only enter numeric characters only for Category Code";
        return false;
      }
      form.post("/category-create", {
        preserveScroll: true,
        onSuccess: () => {
          form.reset();
          validation.number = "";
        },
      });
    }

    return { form, submit, validation };
  },
  watch: {
    params: {
      handler() {
        this.$inertia.get(this.route("category"), this.params, {
          replace: true,
          preserveState: true,
        });
      },
      deep: true,
    },
  },
};

</script>
