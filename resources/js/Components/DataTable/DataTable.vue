<template>
  <div class="flex flex-col">
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="align-middle inline-block min-w-full sm:px-6 lg:px-8">
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
                  <div class="flex justify-between">
                    <div
                      class="w-full"
                      style="cursor: pointer"
                      @click="$emit('sort', 'category_code')"
                    >
                      Code
                    </div>
                    <ArrowDownIcon
                      class="h-3 w-3"
                      v-if="
                        params.field === 'category_code' &&
                        params.direction === 'desc'
                      "
                    />
                    <ArrowUpIcon
                      class="h-3 w-3"
                      v-if="
                        params.field === 'category_code' &&
                        params.direction === 'asc'
                      "
                    />
                  </div>
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
                  "
                >
                  <div class="flex justify-between">
                    <div
                      class="w-full"
                      style="cursor: pointer"
                      @click="$emit('sort', 'category_name')"
                    >
                      Category Name
                    </div>
                    <div>
                      <ArrowDownIcon
                        class="h-3 w-3"
                        v-if="
                          params.field === 'category_name' &&
                          params.direction === 'desc'
                        "
                      />
                    </div>

                    <ArrowUpIcon
                      class="h-3 w-3"
                      v-if="
                        params.field === 'category_name' &&
                        params.direction === 'asc'
                      "
                    />
                  </div>
                </th>

                <th
                  scope="col"
                  class="
                    px-6
                    py-3
                    text-left text-xs
                    font-medium
                    text-gray-500
                    uppercase
                    tracking-wider
                  "
                >
                  Action
                </th>
              </tr>
            </thead>
            <tbody v-if="values" class="bg-white divide-y divide-gray-200">
              <tr v-for="value in values.data" :key="value.id">
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
                        {{ value.category_code }}
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">
                    {{ value.category_name }}
                  </div>
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
                      href="#"
                      class="text-indigo-600 hover:text-indigo-500"
                      title="Edit"
                    >
                      <div class="mx-1">
                        <PencilIcon class="h-5 w-5" />
                      </div>
                    </a>

                    <a
                      href="#"
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
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { TrashIcon } from "@heroicons/vue/solid";
import { PencilIcon } from "@heroicons/vue/solid";
import { ArrowDownIcon } from "@heroicons/vue/solid";
import { ArrowUpIcon } from "@heroicons/vue/solid";

export default {
  props: ["values", "params"],
  components: {
    TrashIcon,
    PencilIcon,
    ArrowDownIcon,
    ArrowUpIcon,
  },
};
</script>