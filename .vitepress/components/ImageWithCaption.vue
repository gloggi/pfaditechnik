<script setup>
import { defineProps } from "vue";

const props = defineProps({
  imgSrc: {
    type: String,
    required: true,
  },
  sideCaption: {
    type: Boolean,
    default: false,
  },
});
</script>
<template>
  <div class="flex justify-start items-start w-full" :class="{
    'md:flex-row space-x-2': sideCaption,
    'flex-col': !sideCaption,
  }">
  <div :class="{
    'w-1/2': sideCaption,
    'w-full': !sideCaption,
  }">
    <a :href="imgSrc" target="_blank" class="">
      <img class="rounded-md" :src="imgSrc"  />
    </a>
  </div>
  <div :class="{
    'w-1/2': sideCaption,
    'w-full': !sideCaption,
  }">
    <div>
    <div class="text-sm pt-1 pb-2 break-words break hyphens-auto">
      <slot></slot>
    </div>
  </div>
  </div>
  </div>
</template>
