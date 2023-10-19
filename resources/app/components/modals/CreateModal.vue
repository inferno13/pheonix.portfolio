<template>
  <va-modal v-model="showModal" hide-default-actions :title="t('modals.create')">
    <template #header>
      <va-card-content> <ResourceForm :schema="schema" :form="form" @form:submit="onFormSubmit" /> </va-card-content>
    </template>
  </va-modal>
</template>

<script setup>
  import { defineProps, defineEmits, computed } from 'vue'
  import { useI18n } from 'vue-i18n'
  import ResourceForm from '../forms/ResourceForm.vue'

  const { t } = useI18n()

  const emit = defineEmits(['modal:toggle', 'form:submit'])

  const onFormSubmit = (form) => {
    emit('form:submit', form)
  }

  const props = defineProps({
    form: {
      default: () => {
        return {}
      },
      type: Object,
      required: true,
    },
    schema: {
      default: () => [],
      type: Array,
      required: true,
    },
    show: {
      default: false,
      type: Boolean,
      required: true,
    },
    title: {
      default: '',
      type: String,
      required: false,
    },
  })

  const showModal = computed({
    get() {
      return props.show
    },
    set(value) {
      emit('modal:toggle', value)
    },
  })
</script>

<style>
  .va-modal .va-card__content {
    padding: 0 !important;
  }
</style>
