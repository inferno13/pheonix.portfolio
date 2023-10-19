<template>
  <TabbedViewItem>
    <template #body>
      <template v-if="props.item.name === 'deposit_transactions'">
        {{ t(`notifications.${props.item.name}`) }} {{ props.item.details.amount }}
        {{ props.item.details.deposit_method.ticker }}
      </template>
      <template v-else-if="props.item.name === 'withdraw_transactions'">
        {{ t(`notifications.${props.item.name}`) }} {{ props.item.details.amount }}
        {{ 'PX' }}
      </template>
      <template v-else-if="props.item.name === 'marketing_transactions'">
        {{ t(`notifications.${props.item.name}`) }} {{ props.item.details.amount }}
        {{ 'PX' }}
      </template>
      <template v-else-if="props.item.name === 'subscription_transactions'">
        {{ t(`notifications.${props.item.name}`) }} {{ props.item.details.amount }}
        {{ 'PX' }}
      </template>
      <template v-else-if="props.item.name === 'bonus_transactions'">
        {{ t(`notifications.${props.item.name}`) }} {{ props.item.details.amount }}
        {{ 'PX' }}
      </template>
      <template v-else-if="props.item.name === 'transfer_transactions'">
        {{ t(`notifications.${props.item.name}`) }} {{ props.item.details.amount }} PX {{ t('utils.from') }}
        {{ props.item.details.sender.username }} {{ t('utils.to') }}
        {{ props.item.details.recipient.username }}
      </template>
      <template v-else>
        {{ props.item }}
      </template>
    </template>
    <template #footer>
      <div class="Date"><Date :date="props.item.created_at" /></div>
    </template>
  </TabbedViewItem>
</template>

<script setup>
  import { defineProps } from 'vue'
  import { useI18n } from 'vue-i18n'
  import Date from '../../components/date/Date.vue'
  import TabbedViewItem from '../../components/tabbed-view/TabbedViewItem.vue'

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
