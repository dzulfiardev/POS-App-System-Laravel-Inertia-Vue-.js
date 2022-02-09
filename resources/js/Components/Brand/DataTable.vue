<template>
  <div class="flex flex-col">
    <SuccessNotification :message="message.success" />
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="grid gap-2 grid-cols-1 md:grid-cols-3 my-2 px-1">
          <div>
            <transition name="slide-fade">
              <button
                class="
                  hidden
                  sm:inline-flex
                  justify-center
                  py-2
                  px-2
                  border border-transparent
                  shadow-sm
                  text-sm
                  font-medium
                  rounded-md
                  text-white
                  bg-red-400
                  hover:bg-red-500
                  focus:outline-none
                  focus:ring-2
                  focus:ring-offset-2
                  focus:ring-red-300
                  transition
                  duration-350
                  ease-out
                "
                v-if="checkbox.single.length > 0"
                @click="bulkDestroy"
              >
                <TrashIcon class="h-4 w-4" />
                Selected Delete
              </button>
            </transition>
          </div>
          <div></div>
          <div>
            <input
              type="search"
              aria-label="Search"
              placeholder="Search..."
              class="block w-full rounded-md border-gray-300 shadow-sm"
              v-model="params.search"
              @keyup="searchType"
            />
            <transition name="slide-fade">
              <button
                class="
                  sm:hidden
                  inline-flex
                  justify-center
                  py-1
                  px-2
                  my-2
                  border border-transparent
                  shadow-sm
                  text-sm
                  font-medium
                  rounded-md
                  text-white
                  bg-red-400
                  hover:bg-red-500
                  focus:outline-none
                  focus:ring-2
                  focus:ring-offset-2
                  focus:ring-red-300
                  transition
                  duration-350
                  ease-out
                "
                v-if="checkbox.single.length > 0"
                @click="bulkDestroy()"
              >
                <TrashIcon class="h-4 w-4" />
                Selected Delete
              </button>
            </transition>
          </div>
        </div>

        <div
          class="shadow overflow-hidden border border-gray-200 sm:rounded-lg"
        >
          <table id="data-table" class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th
                  scope="col"
                  class="
                    py-3
                    px-6
                    text-left text-xs
                    font-medium
                    text-gray-500
                    uppercase
                    tracking-wider
                  "
                >
                  <input
                    type="checkbox"
                    class="
                      aapperance-none
                      checked:bg-blue-500
                      indeterminate:bg-gray-300
                      cursor-pointer
                      default:ring-2
                      hover:bg-blue-500
                    "
                    v-if="tableHead.checkboxAll"
                    v-model="checkbox.all"
                    @click="selectAll()"
                  />
                </th>

                <th
                  scope="col"
                  class="
                    py-3
                    px-6
                    text-left text-xs
                    font-medium
                    text-gray-500
                    uppercase
                    tracking-wider
                    hover:bg-blue-50
                    transition
                    duration-350
                  "
                  v-for="(th, index) in tableHead.th"
                  :key="index"
                >
                  <div
                    class="flex justify-between"
                    style="height: 100%"
                    v-if="th.sort"
                  >
                    <div
                      class="w-full"
                      style="cursor: pointer"
                      @click="sort(th.sortName)"
                    >
                      {{ th.name }}
                    </div>
                    <ArrowDownIcon
                      class="h-3 w-3"
                      v-if="
                        params.field === th.sortName &&
                        params.direction === 'desc'
                      "
                    />
                    <ArrowUpIcon
                      class="h-3 w-3"
                      v-if="
                        params.field === th.sortName &&
                        params.direction === 'asc'
                      "
                    />
                  </div>

                  <div class="flex justify-between" v-else>
                    {{ th.name }}
                  </div>
                </th>
              </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">
              <tr
                class="hover:bg-blue-50 transition duration-350"
                v-for="val in dataList.table"
                :key="val.id"
              >
                <td class="px-6 py-4 whitespace-nowrap">
                  <input
                    type="checkbox"
                    class="
                      apperance-none
                      checked:bg-blue-500
                      indeterminate:bg-gray-300
                      cursor-pointer
                      default:ring-2
                      hover:bg-blue-500
                      transition
                      duration-350
                      ease-out
                    "
                    :id="val.id"
                    v-model="checkbox.single"
                    :value="val.id"
                  />
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <!-- <div class="flex-shrink-0 h-10 w-10">
                      <img
                        class="h-10 w-10 rounded-full"
                        src=""
                        alt="a"
                      />
                    </div> -->
                    <div>
                      <div class="text-sm font-medium text-gray-900">
                        {{ val.brand_code }}
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">{{ val.brand_name }}</div>
                </td>
                <td
                  class="
                    px-6
                    py-4
                    whitespace-nowrap
                    text-left text-sm
                    font-medium
                  "
                >
                  <!-- Edit -->
                  <div class="flex">
                    <a
                      href=""
                      @click.prevent="$emit('edit', val.id)"
                      class="text-indigo-600 hover:text-indigo-500"
                      title="Edit"
                    >
                      <div class="mx-1">
                        <PencilIcon class="h-5 w-5" />
                      </div>
                    </a>

                    <a
                      href=""
                      @click.prevent="destroy(val.id, val.brand_name)"
                      class="text-indigo-600 hover:text-indigo-500"
                      title="Delete"
                    >
                      <div class="mx-1 text-center">
                        <TrashIcon class="h-5 w-5" />
                      </div>
                    </a>
                  </div>
                </td>
              </tr>
            </tbody>

            <tbody
              v-if="loader.table"
              class="bg-white divide-y divide-gray-200 whitespace-nowrap"
            >
              <tr>
                <td :colspan="tableHead.th.length + 1">
                  <div class="py-4 text-center">Please Wait...</div>
                </td>
              </tr>
            </tbody>
            <!--  -->
          </table>
        </div>
      </div>
    </div>
  </div>

  <Pagination class="mt-6" :links="links" :params="params" />

  <!-- Delete Modal -->
  <TransitionRoot as="template" :show="modal.delete">
    <DeleteModal
      :deleteModal="deleteModal"
      @acceptDestroy="acceptDestroy"
      @close="closeDeleteModal"
      :text="modal.text"
    />
  </TransitionRoot>

  <!-- Bulk Delete Modal -->
  <TransitionRoot as="template" :show="modal.bulkDelete">
    <DeleteModal
      @close="closeBulkDeleteModal"
      @acceptDestroy="acceptBulkDestroy"
      :text="modal.text"
    />
  </TransitionRoot>
</template>

<script>
import { reactive } from "vue";
import { TrashIcon } from "@heroicons/vue/solid";
import { PencilIcon } from "@heroicons/vue/solid";
import { ArrowDownIcon } from "@heroicons/vue/solid";
import { ArrowUpIcon } from "@heroicons/vue/solid";
import DeleteModal from "../Modal/DeleteModal.vue";
import { TransitionRoot } from "@headlessui/vue";
import SuccessNotification from "./SuccessNotification.vue";
import BulkDeleteModal from "../Modal/DeleteModal.vue";
import Pagination from "../Pagination/PaginationAjax.vue";
import NProgress from "nprogress";

export default {
  components: {
    TrashIcon,
    PencilIcon,
    ArrowDownIcon,
    ArrowUpIcon,
    DeleteModal,
    TransitionRoot,
    SuccessNotification,
    BulkDeleteModal,
    Pagination,
  },
  props: {
    tableHead: Object,
    dataList: Object,
    params: Object,
    links: Object,
    path: Object,
    allDataTablePath: String,
    loader: Object,
  },
  emits: ["dataTable", "edit"],
  watch: {
    params: {
      handler() {
        let params = this.params;

        Object.keys(params).forEach((key) => {
          if (params[key] == "") {
            delete params[key];
          }
        });

        NProgress.start();
        axios
          .get("/" + this.allDataTablePath, {
            params: params,
          })
          .then((res) => {
            NProgress.done();
            this.dataList.table = res.data.success.data;
            this.dataList.pagination = res.data.success.links;
          })
          .catch((err) => {
            NProgress.done();
            console.log(err);
          });
      },
      deep: true,
    },
  },
  setup(props, { emit }) {
    const modal = reactive({
      delete: false,
      bulkDelete: false,
      text: "",
    });

    const action = reactive({
      id: null,
    });

    const message = reactive({
      success: "",
    });

    const checkbox = reactive({
      all: false,
      single: [],
    });

    function closeDeleteModal() {
      modal.delete = !modal.delete;
      action.id = null;
    }

    function sort(field) {
      if (field) {
        props.params.field = field;
        props.params.direction =
          props.params.direction === "asc" ? "desc" : "asc";
      } else {
        props.params.field = "";
        props.params.direction = "";
      }
    }

    function searchType() {
      props.params.page = "";
    }

    function destroy(id, name) {
      action.id = id;
      modal.delete = !modal.delete;
      modal.text = "Are you sure to delete " + name;
    }

    function bulkDestroy() {
      modal.bulkDelete = !modal.bulkDelete;
      modal.text = "Are You Sure Delete " + checkbox.single.length + " Data?";
    }

    function selectAll() {
      checkbox.single = [];
      const table = props.dataList.table;

      if (!checkbox.all) {
        for (let i in table) {
          checkbox.single.push(table[i].id);
        }
      }
    }

    function successMessage(text) {
      window.scrollTo({
        top: 0,
        behavior: "smooth",
      });
      message.success = text;
      setTimeout(() => {
        message.success = null;
      }, 3000);
    }

    function acceptDestroy() {
      axios
        .delete("/" + props.path.destroy, {
          data: {
            id: action.id,
          },
        })
        .then((res) => {
          successMessage(res.data.success);
          action.id = null;
          modal.delete = false;
          emit("dataTable");
        })
        .catch((err) => {
          console.log(err);
        });
    }

    function acceptBulkDestroy() {
      axios
        .delete("/" + props.path.bulkDestroy, {
          data: {
            id: checkbox.single,
          },
        })
        .then((res) => {
          successMessage(res.data.success);
          closeBulkDeleteModal();
          emit("dataTable");
          checkbox.all = false;
          checkbox.single = [];
        })
        .catch((err) => {
          console.log(err);
        });
    }

    function closeBulkDeleteModal() {
      modal.bulkDelete = !modal.bulkDelete;
    }

    return {
      modal,
      action,
      message,
      checkbox,
      searchType,
      destroy,
      acceptDestroy,
      closeDeleteModal,
      selectAll,
      bulkDestroy,
      acceptBulkDestroy,
      closeBulkDeleteModal,
      sort,
    };
  },
};
</script>