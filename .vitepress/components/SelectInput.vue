<template>
  <label class="block text-book-red  text-sm font-bold mb-2 upper">
        {{ label }} {{ required ? "*" : "" }}
    </label>
    <select
      v-model="payload"
      class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-book-red focus:border-chapter-red"
      :placeholder="placeholder || label"
    >
        <option
            v-for="option in options"
            :key="option.value"
            :value="option.value"
        >
            {{ option.label }}
        </option>
    </select>

</template>
<script>
export default {
  props: ["modelValue", "label", "placeholder", "options", "required"],
  computed: {
    payload: {
      get() {
        return this.modelValue;
      },
      set(value) {
        this.$emit("update:modelValue", value);
      },
    },
  },
};
</script>