<template>
  <div class="Nameplate">
    <img class="Nameplate__Image" :src="props.image" />
    <div class="Nameplate__Name">{{ props.name }}</div>
  </div>
</template>

<script setup>
  import { defineProps } from 'vue'

  const props = defineProps({
    image: {
      default: '',
      required: true,
      type: String,
    },
    name: {
      default: '',
      required: true,
      type: String,
    },
  })
</script>

<style lang="scss">
  .Nameplate {
    display: flex;
    align-items: center;
    justify-content: center;
    &__Image {
      width: 2em;
      height: 2em;
    }
    &__Name {
      margin-left: 0.5em;
    }
  }
</style>
