<template>
  <div class="tickets">
    <div class="cent-nt">
      <h3>{{ t('pages.support') }}</h3>
    </div>
    <div class="CreateButton">
      <va-button @click="onCreateTicket">{{ t('support.create_button') }}</va-button>
    </div>
    <TabbedView :tabs="tabs" :items="tickets" :filter-by="filterBy">
      <template #item="{ item }">
        <Ticket :item="item" />
      </template>
    </TabbedView>
  </div>
  <CreateModal
    :form="form"
    :show="showModal"
    :schema="schema"
    @modal:toggle="onToggleModal"
    @form:submit="onTicketSubmit"
  />
</template>

<script setup>
  import { onMounted, ref } from 'vue'
  import { useI18n } from 'vue-i18n'
  import { useToast, useColors } from 'vuestic-ui'
  import { Form } from 'vform'
  import axios from 'axios'
  import CreateModal from '../../components/modals/CreateModal.vue'
  import TabbedView from '../../components/tabbed-view/TabbedView.vue'
  import Ticket from './Ticket.vue'
  const { t } = useI18n()
  const tickets = ref()
  const showModal = ref(false)
  const tabs = ['created', 'closed']
  const { init: initToast } = useToast()
  const { colors } = useColors()

  const form = ref(
    new Form({
      title: '',
      category: '',
      description: '',
    }),
  )

  const schema = ref([
    {
      fields: {
        title: {
          type: 'input',
        },
        ticket_category: {
          type: 'select',
          options: [],
          selected: null,
        },
        description: {
          type: 'input',
        },
      },
    },
  ])

  const getTickets = async () => {
    const { data } = await axios.get('/api/ticket')
    tickets.value = data.data
  }

  const getTicketCategories = async () => {
    const { data } = await axios.get('/api/ticket_category')
    schema.value[0].fields.ticket_category.options = data.data.map((option) => ({
      text: option.name,
      value: option.id,
    }))
    form.value.category = schema.value[0].fields.ticket_category.options[0]
  }

  const loadData = async () => {
    await getTicketCategories()
    await getTickets()
  }

  const onCreateTicket = () => {
    showModal.value = true
  }

  const onTicketSubmit = async (form) => {
    showModal.value = false
    await form.post(`/api/ticket`)
    initToast({ message: t('support.ticket_success'), color: colors.info })
    getTickets()
  }

  const onToggleModal = (value) => {
    showModal.value = value
  }

  const filterBy = (item) => {
    if (['awaiting_user', 'awaiting_support'].includes(item.status)) {
      return 'created'
    }
    return 'closed'
  }
  onMounted(loadData)
</script>

<style lang="scss">
  .CreateButton {
    margin-bottom: 1em;
    display: flex;
    justify-content: center;

    .va-button {
      --ca48c38c: var(--bs-purple) !important;
      text-transform: uppercase;
      font-weight: bold;
    }
  }
</style>
