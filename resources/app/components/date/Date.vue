<template>
  <span>{{ moment(date).format(dateFormat) }}</span>
</template>

<script setup>
  import { defineProps, computed } from 'vue'
  import { useI18n } from 'vue-i18n'
  import moment from 'moment'

  const { t } = useI18n()

  const props = defineProps({
    date: {
      type: String,
      required: true,
    },
    format: {
      type: String,
      required: false,
      default: '',
    },
  })

  const dateFormat = computed(() => {
    if (!props.format) {
      return `DD.MM.YYYY ${t('utils.at')} HH:mm`
    }
    return props.format
  })
</script>
