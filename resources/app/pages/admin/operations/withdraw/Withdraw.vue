<template>
  <PageHeader />
  <div class="withdraw-operations">
    <va-card>
      <va-card-content>
        <ResourceTable :custom-actions="customActions" :columns="columns" :endpoint="endpoint" />
      </va-card-content>
    </va-card>
  </div>
</template>

<script setup>
  import axios from 'axios'
  import { useI18n } from 'vue-i18n'
  import PageHeader from '../../../../components/page-header/PageHeader.vue'
  import { useColors, useToast } from 'vuestic-ui'
  import ResourceTable from '../../../../components/tables/ResourceTable.vue'

  const { t } = useI18n()

  const columns = [
    { key: 'user', label: 'user_nameplate_attr', name: 'user_nameplate_attr' },
    { key: 'deposit_method', label: 'crypto_currency', name: 'crypto_currency' },
    { key: 'deposit_method', label: 'crypto_amount', name: 'crypto_amount' },
    { key: 'address' },
    { key: 'created_at' },
  ]
  const endpoint = '/api/admin/withdraw'
  const { init: initToast } = useToast()
  const { getColors } = useColors()
  const colors = getColors()

  const withdraw = async (id) => {
    await axios.post(endpoint, { id })
    initToast({ message: `${t('withdraw.success')}!`, color: colors.success })
  }

  const customActions = [
    {
      icon: 'drive_file_rename_outline',
      click: (item) => {
        item.status = 'completed'
        withdraw(item.id)
      },
      isDisabled: (item) => {
        return item.status != 'created'
      },
    },
  ]
</script>

<style>
  .withdraw-operations .va-card__content {
    width: 100%;
    overflow-x: scroll;
  }

  .withdraw-operations {
    width: 90%;
    margin: 2em auto 2em;
  }
  .bg-nt.wd-ad {
    padding: 1.75em 5%;
  }

  .withdraw-operations table a {
    color: var(--bs-purple) !important;
  }

  @media (max-width: 1000px) {
    .withdraw-operations {
      width: 95%;
    }
    .bg-nt.wd-ad {
      padding: 1.75em 2.5%;
    }
  }
</style>
