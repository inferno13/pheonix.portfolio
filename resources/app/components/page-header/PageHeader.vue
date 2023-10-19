<template>
  <div class="PageHeader">
    <h1 class="PageHeader__Header">{{ pageHeader }}</h1>
    <div class="PageHeader__Actions">
      <slot name="actions"></slot>
    </div>
  </div>
</template>

<script setup>
  import { defineProps, computed } from 'vue'
  import { useRoute } from 'vue-router'
  import { useI18n } from 'vue-i18n'
  const { t } = useI18n()

  const props = defineProps({
    header: {
      type: String,
      required: false,
      default: '',
    },
  })

  const pageHeader = computed(() => {
    if (!props.header) {
      return t(`pages.${useRoute().name}`)
    }
    return props.header
  })
</script>

<style lang="scss">
  .PageHeader {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: var(--gray-op-10);
    padding: 1.75em 5%;
    &__Header {
      font-size: 1.5em;
    }
  }
</style>
