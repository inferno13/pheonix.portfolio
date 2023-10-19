<template>
    <div class="bg-nt tc-ad">
        <h3>Техническая поддержка</h3>
    </div>
  <div class="tickets-admin">
    <TicketSection :tickets="supportTickets" :category="t(`dividers.ticket_awaiting_support`)" />
    <TicketSection :tickets="userTickets" :category="t(`dividers.ticket_awaiting_user`)" />
    <TicketSection :tickets="completedTickets" :category="t(`dividers.ticket_completed`)" />
  </div>
</template>

<script setup>
  import { onMounted, ref } from 'vue'
  import axios from 'axios'
  import { useI18n } from 'vue-i18n'
  import TicketSection from './TicketSection.vue'

  const { t } = useI18n()
  const endpoint = '/api/admin/ticket'
  const supportTickets = ref()
  const userTickets = ref()
  const completedTickets = ref()
  const getTickets = async () => {
    const { data } = await axios.get(endpoint)
    supportTickets.value = data.data.filter((ticket) => ticket.status === 'awaiting_support')
    userTickets.value = data.data.filter((ticket) => ticket.status === 'awaiting_user')
    completedTickets.value = data.data.filter((ticket) => ticket.status === 'completed')
  }
  onMounted(getTickets)
</script>
