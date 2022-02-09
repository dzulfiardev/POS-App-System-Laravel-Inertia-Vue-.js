<template>
  <!-- Notification -->
  <transition name="slide-fade">
    <div
      class="
        absolute
        top-0
        right-1
        z-20
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
      v-if="flashMsg.message && visible"
    >
      <div class="flex">
        <CheckCircleIcon class="w-5 h-5 mr-2" />
        {{ flashMsg.message }}
      </div>
    </div>
  </transition>
  <!-- End Notification -->
</template>

<script>
import { CheckCircleIcon } from "@heroicons/vue/outline";

export default {
  props: {
    flashMsg: Object,
  },
  components: {
    CheckCircleIcon,
  },
  data() {
    return {
      visible: false,
    };
  },
  watch: {
    flashMsg: {
      deep: true,
      handler() {
        this.visible = true;
        setTimeout(() => {
          this.visible = false;
        }, 3000);
      },
    },
  },
};
</script>

<style>
</style>