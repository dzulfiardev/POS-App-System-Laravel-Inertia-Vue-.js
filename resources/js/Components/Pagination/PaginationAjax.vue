<template>
  <div v-if="links.length > 3">
    <div class="flex flex-wrap -mb-1">
      <template v-for="(link, k) in links" :key="k">
        <div
          v-if="link.url === null"
          class="
            mr-1
            mb-1
            px-4
            py-3
            text-sm
            leading-4
            text-gray-400
            border
            rounded
          "
          v-html="link.label"
        />
        <a
          v-else
          class="
            mr-1
            mb-1
            px-4
            py-3
            text-sm
            leading-4
            border
            rounded
            hover:bg-blue-300
            focus:border-indigo-500 focus:text-indigo-500
          "
          :class="{ 'bg-blue-700 text-white': link.active }"
          href=""
          @click.prevent="page(link)"
          v-html="link.label"
        >
        </a>
        <!-- :href="link.url" -->
      </template>
    </div>
  </div>
</template>

  
<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
  components: {
    Link,
  },
  props: {
    links: Array,
    params: Object,
  },
  setup(props) {
    function page(link) {
      const pageNum = link.url.substring(link.url.lastIndexOf("=") + 1);
      props.params.page = pageNum;
    }

    return { page };
  },
};
</script> 