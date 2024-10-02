<script setup>
import { useData } from "vitepress";

// https://vitepress.dev/reference/runtime-api#usedata
const { site, frontmatter, title, page } = useData();
</script>

<template>
  <div
    class="flex justify-center w-full min-h-screen h-full background px-2 md:px-0"
  >
    <div
      class="relative m-3 pl-8 pb-8 h-full min-h-[95vh] w-full md:w-2/3 bg-white rounded-r-2xl drop-shadow-2xl"
      :class="{ 'pr-12': !frontmatter.home }"
    >
      <div v-if="!frontmatter.home" class="mt-2 -mb-2">
        <a class="breadcrumblink" href="/">Pfaditechnik</a> /
        <a class="breadcrumblink">{{ page.title }}</a>
      </div>
      <div
        class="absolute right-0"
        :style="`top: ${87 * frontmatter.order + 27}px;`"
      >
        <div
          v-if="!frontmatter.home"
          class="w-8 h-20 bg-book-red rounded-l-lg"
        ></div>
      </div>
      <Content />
    </div>
  </div>
</template>

<style>
.background {
  background-image: url("/background_new.svg");
  background-attachment: fixed;
  background-size: cover;
  background-repeat: no-repeat;
}



.custom-block {
    @apply flex flex-row space-x-2 my-2;
}

.warning.custom-block .custom-block-title {
    @apply size-8 whitespace-nowrap bg-contain bg-no-repeat text-transparent mt-1;
    background-image: url('/warning.svg');
    background-position: left center;
}

.info.custom-block .custom-block-title {
    @apply size-8 whitespace-nowrap bg-contain bg-no-repeat text-transparent mt-0;
    background-image: url('/info.svg');
    background-position: left center;
}

.tip.custom-block .custom-block-title {
  @apply hidden;
}

.tip.custom-block a{
    @apply text-white font-semibold;
}

.tip.custom-block {
    @apply bg-book-red rounded-lg p-5 text-white font-semibold;

}


</style>
