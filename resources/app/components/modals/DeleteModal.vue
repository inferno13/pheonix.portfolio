<template>
  <va-modal v-model="showModal" hide-default-actions :title="title">
    <template #header>
<!--      <va-card-content>-->
<!--        <div>{{ t('modals.delete_confirm') }}</div>-->
<!--      </va-card-content>-->
      <va-card-actions>
        <va-button color="danger" @click="confirm">{{ t('modals.delete_btn') }}</va-button>
      </va-card-actions>
    </template>
  </va-modal>
</template>

<script setup>
  import { defineProps, defineEmits, computed } from 'vue'
  import { useI18n } from 'vue-i18n'
  const emit = defineEmits(['modal:toggle', 'delete:confirm'])

  const { t } = useI18n()

  const props = defineProps({
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

  const confirm = () => {
    emit('delete:confirm')
  }

  const showModal = computed({
    get() {
      return props.show
    },
    set(value) {
      emit('modal:toggle', value)
    },
  })
</script>
