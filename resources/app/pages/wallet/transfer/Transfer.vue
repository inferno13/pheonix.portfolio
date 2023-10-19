<template>
  <div class="history">
    <nav class="cent-nt">
      <h3>Переводы</h3>
    </nav>

    <div class="top-blocks">
      <va-card class="top-card left">
        <h3>
          <i class="fa fa-fw fa-coins"></i>
          {{ t('transfer.transfer') }}
        </h3>
        <div class="input-group">
          <label>{{ t('transfer.address') }}</label>
          <input v-model="form.account" :placeholder="t('transfer.address')" />
        </div>
        <va-form tag="form" @submit.prevent="submit">
          <div class="input-group">
            <label>{{ t('transfer.amount') }}</label>
            <input v-model="form.amount" placeholder="100" />
          </div>
          <button class="light-purple-button dark" type="submit">
              {{ t('transfer.submit') }}
          </button>
        </va-form>
      </va-card>

      <va-card class="top-card address">
        <h3>
          {{ t('transfer.my_account') }}
        </h3>
        <div class="text">{{ t('transfer.my_address') }}</div>
        <Clipboard :message="user.transfer_address" />
      </va-card>
    </div>

      <h4 class="block-title">
          {{ t('transfer.transfer_history') }}
      </h4>
    <va-card class="center-card">
      <div class="inner">
        <ResourceTable :columns="columns" :endpoint="endpoint" />
      </div>
    </va-card>
  </div>
</template>

<script setup>
  import { useI18n } from 'vue-i18n'
  import Form from 'vform'
  import { ref } from 'vue'
  import { useToast } from 'vuestic-ui'
  import { useGlobalStore } from '../../../stores/global-store'
  import ResourceTable from '../../../components/tables/ResourceTable.vue'
  import Clipboard from '../../../components/clipboard/Clipboard.vue'

  import { storeToRefs } from 'pinia'
  const { t } = useI18n()
  const GlobalStore = useGlobalStore()
  const { init: initToast } = useToast()
  const endpoint = '/api/transfer'
  const { user } = storeToRefs(GlobalStore)

  const columns = [
    { key: 'status', sortable: true },
    { key: 'sender.username', label: 'sender', name: 'sender', sortable: true },
    { key: 'recipient.username', label: 'recipient', name: 'recipient', sortable: true },
    { key: 'amount', label: 'transfer_amount', name: 'transfer_amount', sortable: true },
    { key: 'created_at' },
  ]

  const form = ref(
    new Form({
      account: '',
      amount: '',
    }),
  )

  const submit = async () => {
    await form.value.post(endpoint)
    initToast(t('transfer.transfer_success'))
  }
</script>
