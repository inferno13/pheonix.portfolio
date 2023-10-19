<template>
  <va-button text-color="#6f42c1" color="rgba(111, 66, 193, 0.5)" icon="person_add" @click="onButtonClick">
    {{ t('users.add') }}
  </va-button>
</template>

<script setup>
  import { defineEmits } from 'vue'
  import { useI18n } from 'vue-i18n'

  const { t } = useI18n()
  const emit = defineEmits(['button:click'])

  const onButtonClick = () => {
    emit('button:click')
  }
</script>
