<template>
  <va-icon class="CheckCancel" :color="props.value ? 'success' : 'danger'" :name="props.value ? 'check' : 'close'" />
</template>

<script setup>
  import { defineProps } from 'vue'

  const props = defineProps({
    value: {
      required: true,
      type: Boolean,
    },
  })
</script>

<style lang="scss">
  .CheckCancel {
    & .material-icons {
      font-weight: bold;
      display: block;
    }
  }
</style>
