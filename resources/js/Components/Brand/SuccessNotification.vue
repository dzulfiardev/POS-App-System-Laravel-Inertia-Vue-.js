<template>
  <!-- Notification -->
  <transition name="slide-fade">
    <div
      class="
        absolute
        top-0
        right-1
        z-40
        w-96
        py-3
        px-4
        my-2
        bg-green-300
        text-green-800
        rounded-md
        font-bold
        opacity-90
      "
      v-if="message"
    >
      <div class="flex">
        <CheckCircleIcon class="w-5 h-5 mr-2" />
        {{ message }}
      </div>
    </div>
  </transition>
  <!-- End Notification -->
</template>

<script>
import { CheckCircleIcon } from "@heroicons/vue/outline";

export default {
  props: {
    message: String,
  },
  components: {
    CheckCircleIcon,
  },
  // data() {
  //   return {
  //     visible: false,
  //   };
  // },
  // watch: {
  //   message: {
  //     deep: true,
  //     handler() {
  //       this.visible = true;
  //       setTimeout(() => {
  //         this.visible = false;
  //       }, 3000);
  //     },
  //   },
  // },
};
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