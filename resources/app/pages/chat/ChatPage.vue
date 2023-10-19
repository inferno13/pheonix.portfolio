<template>
  <div class="bg-nt cht">
    <span>
      <i class="fa fa-fw fa-arrow-left" />
      <h3>Техническая поддержка</h3>
    </span>

    <span>
      <router-link to="/support"> Техническая поддержка </router-link>
      <span class="slash">/</span>
      Чат
    </span>
  </div>

  <div v-if="ticket" class="chat">
    <div class="chat-container">
      <va-card class="chat-block">
        <chat v-model="ticket.messages" :disabled="ticket.status === 'completed'" @update:model-value="sendMessage" />
      </va-card>
      <div class="table-block">
        <table class="va-table va-table--hoverable va-table--striped">
          <tbody>
            <tr>
              <td>{{ t('tables.headings.user') }}</td>
              <td>
                <router-link :to="`/profile/${ticket.user.id}`">{{ ticket.user.username }}</router-link>
              </td>
            </tr>
            <tr>
              <td>{{ t('tables.headings.category') }}</td>
              <td>{{ ticket.category }}</td>
            </tr>
            <tr>
              <td>{{ t('tables.headings.title') }}</td>
              <td>{{ ticket.title }}</td>
            </tr>
            <tr>
              <td>{{ t('tables.headings.status') }}</td>
              <td>
                <va-badge :text="t(`status.${ticket.status}`)" :color="getBooleanColor(ticket.status)" />
              </td>
            </tr>
            <tr>
              <td>{{ t('tables.headings.description') }}</td>
              <td>{{ ticket.description }}</td>
            </tr>
            <tr>
              <td>{{ t('tables.headings.created_at') }}</td>
              <td>{{ moment(ticket.created_at).format(`DD.MM.YYYY ${t('utils.at')} HH:mm`) }}</td>
            </tr>
          </tbody>
        </table>
        <button class="light-purple-button dark" :disabled="ticket.status === 'completed'" @click="closeTicket">
          {{ t('chat.close_ticket') }}
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
  import moment from 'moment'
  import { onMounted, ref } from 'vue'
  import { useI18n } from 'vue-i18n'
  import axios from 'axios'
  import { storeToRefs } from 'pinia'
  import { useRoute } from 'vue-router'
  import Chat from './Chat.vue'
  import { useGlobalStore } from '../../stores/global-store'
  import { getBooleanColor } from '../../utils'

  const GlobalStore = useGlobalStore()
  const { user } = storeToRefs(GlobalStore)

  const { params } = useRoute()
  const { id } = params
  const { t } = useI18n()
  const ticket = ref(null)

  const getTicket = async () => {
    const { data } = await axios.get(`/api/ticket/${id}`)
    ticket.value = data.data
  }

  const closeTicket = async () => {
    await axios.put(`/api/ticket/${id}`, { status: 'completed' })
    ticket.value.status = 'completed'
  }

  window.Echo.private(`chat.ticket.${id}`).listen('MessageSent', (e) => {
    if (user.value.id !== e.message.user_id) {
      ticket.value.messages.push({
        user_id: e.message.user_id,
        text: e.message.text,
        username: e.message.username,
      })
    }
  })
  const sendMessage = (payload) => {
    axios.post('/api/chat', { text: payload[payload.length - 1].text, ticket_id: id })
  }
  onMounted(getTicket)
</script>

<style lang="scss"></style>
