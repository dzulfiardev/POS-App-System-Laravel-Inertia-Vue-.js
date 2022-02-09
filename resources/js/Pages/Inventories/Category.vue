<template>
  <app-layout :title="title">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ heading }}
      </h2>
    </template>
    <SuccessNotification :flashMsg="$page.props.flash" />

    <CategoryMain :data="data" :filters="filters" />
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
import SuccessNotification from "../../Components/ToastNotification/SuccessNotification.vue";
import DeleteNotification from "../../Components/ToastNotification/SuccessNotification.vue";

export default defineComponent({
  props: {
    title: String,
    heading: String,
    data: Object,
    filters: Object,
  },
  components: {
    AppLayout,
    CategoryMain,
    SuccessNotification,
    DeleteNotification,
  },
});
</script>

<style>
.slide-fade-enter-active {
  transition: all 0.5s ease;
}
.slide-fade-leave-active {
  transition: all 0.2s cubic-bezier(1, 0.5, 0.8, 1);
}
.slide-fade-enter,
.slide-fade-leave-to {
  transform: translateX(10px);
  opacity: 0;
}
</style>