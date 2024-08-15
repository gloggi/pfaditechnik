<script setup>
import { defineProps } from "vue";

const props = defineProps({
  link: {
    type: String,
    required: true,
  }
});

const goToLink = () => {
  window.location.href = props.link
}
</script>
<template>
<button class="rounded-lg p-3 text-white bg-book-red" @click="goToLink">
    <slot></slot>
</button>
</template>