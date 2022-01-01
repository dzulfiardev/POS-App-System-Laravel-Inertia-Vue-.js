<template>
  <app-layout :title="title">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ heading }}
      </h2>
    </template>
    <CategoryMain :data="data" />
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg"></div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import CategoryMain from "../../Components/Category/CategoryMain.vue";

export default defineComponent({
  props: ["title", "heading", "data"],
  components: {
    AppLayout,
    CategoryMain,
  },
});
</script>