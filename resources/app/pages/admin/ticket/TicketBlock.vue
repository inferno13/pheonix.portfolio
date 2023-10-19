<template>
  <va-card
    class="TicketBlock"
    :to="`/chat/${props.ticket.id}`"
    stripe
    :stripe-color="mapTicketStatusToColor(props.ticket.status)"
  >
    <h4 class="title">{{ props.ticket.category }}</h4>
    <div class="TicketBlock__description">
      {{ props.ticket.description }}
    </div>

    <div class="TicketBlock__user">
      <div>
        <b>{{ props.ticket.user.username }}</b>
      </div>
      <div>
        {{ t('utils.full_name') }}:
        {{ props.ticket.full_name || t(`utils.not_defined`) }}
      </div>
    </div>

    <div class="TicketBlock__date">
      <Date :date="ticket.created_at" />
    </div>
  </va-card>
</template>

<script setup>
  import { defineProps } from 'vue'
  import { useI18n } from 'vue-i18n'
  import Date from '../../../components/date/Date.vue'

  const { t } = useI18n()
  const props = defineProps({
    ticket: {
      type: Object,
      default: () => {
        return {}
      },
    },
  })

  const mapTicketStatusToColor = (status) => {
    if (status === 'awaiting_support') {
      return 'warning'
    }
    if (status === 'awaiting_user') {
      return 'success'
    }
    return 'info'
  }
</script>
