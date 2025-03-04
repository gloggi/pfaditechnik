<script setup>
import { defineProps } from "vue";

const props = defineProps({
  imgSrc: {
    type: String,
    required: true,
  },
});
</script>
<template>
  <figure class="image">
    <img class="rounded-md" :src="imgSrc" />
  </figure>
</template>