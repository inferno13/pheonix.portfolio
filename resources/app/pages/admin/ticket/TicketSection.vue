<template>
  <div v-if="props.tickets.length > 0" class="row">
    <div class="flex xs12">
      <h3>{{ props.category }}</h3>
      <div class="blocks-container">
        <div v-for="ticket in props.tickets" :key="ticket.id" class="ticket-container">
          <TicketBlock :ticket="ticket" />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
  import { defineProps } from 'vue'
  import TicketBlock from './TicketBlock.vue'

  const props = defineProps({
    tickets: {
      type: Array,
      default: () => {
        return []
      },
    },
    category: {
      type: String,
      default: '',
    },
  })
</script>
