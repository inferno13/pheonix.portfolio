<template>
  <TabbedViewItem :to="`/chat/${props.item.id}`">
    <template #body>
      <div>
        {{ props.item.description }}
      </div>
      <div>{{ t(`status.${props.item.status}`) }}</div>
    </template>
    <template #footer>
      <div>
        {{ t(`status.${props.item.status}`) }}
        <span class="Date">
          {{ moment(props.item.updated_at).format(`DD.MM.YYYY ${t('utils.at')} HH:mm`) }}
        </span>
      </div>
      <div>{{ t('support.category') }}: {{ props.item.category }}</div>
    </template>
  </TabbedViewItem>
</template>

<script setup>
  import { defineProps } from 'vue'
  import { useI18n } from 'vue-i18n'
  import TabbedViewItem from '../../components/tabbed-view/TabbedViewItem.vue'
  import moment from 'moment'

  const { t } = useI18n()

  const props = defineProps({
    item: {
      type: Object,
      required: true,
    },
  })
</script>

<style lang="scss">
  .Date {
    font-weight: bold;
  }
</style>
