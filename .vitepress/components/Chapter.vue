<script setup>
import { defineProps } from "vue";

const props = defineProps({
  link: {
    type: String,
    required: true,
  },
  image: {
    type: String,
    required: true,
  },
});
</script>
<template>
  <a
    :href="link"
    class="rounded-l-2xl w-full bg-chapter-red flex items-center cursor-pointer no-underline mt-2"
  >
    <div class="size-20 rounded-2xl bg-book-red">
      <img :src="image" class="w-full h-full p-2 my-0" />
    </div>
    <div class="pl-3">
      <p
        class="text-4xl font-semibold font-bebas uppercase text-book-red"
      >
        <slot></slot>
      </p>
    </div>
  </a>
</template>

<style></style>
