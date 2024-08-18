<template>
    <div class="w-full">
    <label class="block text-book-red  text-sm font-bold mb-2 upper">
        {{ label }} {{ required ? "*" : "" }}
    </label>
    <input
      v-model="payload"
      
      class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-book-red focus:border-chapter-red"
      type="text"
      :placeholder="placeholder || label"
      :required="required"
    />
</div>
</template>
<script>
export default {
  props: ["modelValue", "label", "placeholder"],
  props: {
    modelValue: {
      type: String,
    },
    label: {
      type: String,
    },
    placeholder: {
      type: String,
    },
    required: {
      type: Boolean,
      default: true,
    },
  },
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