<template>
  <div class="Bonus">
    <PageHeader />
    <Content>
      <va-card>
        <va-card-title>{{ t('bonus.profit') }}</va-card-title>
        <va-card-content>{{ profit }} {{ t('bonus.currency') }}</va-card-content>
      </va-card>
      <va-card>
        <ResourceTable :custom-actions="customActions" :endpoint="endpoint" :columns="columns" />
      </va-card>
    </Content>
  </div>
</template>

<script setup>
  import { ref, onMounted } from 'vue'
  import axios from 'axios'
  import { useI18n } from 'vue-i18n'
  import { useToast, useColors } from 'vuestic-ui'
  import Content from '../../../components/content/Content.vue'
  import PageHeader from '../../../components/page-header/PageHeader.vue'
  import ResourceTable from '../../../components/tables/ResourceTable.vue'
  const { init: initToast } = useToast()
  const { colors } = useColors()
  const { t } = useI18n()
  const endpoint = '/api/admin/bonus'
  const profit = ref()

  const columns = [
    { key: 'user', label: 'user_nameplate_attr', name: 'user_nameplate_attr' },
    { key: 'has_bonus' },
    { key: 'pull_status' },
  ]

  const customActions = [
    {
      icon: 'grade',
      isDisabled: (data) => data.has_bonus,
      click: async (value) => {
        const { data } = await axios.put(`/api/admin/bonus/${value.id}`)
        const bonus = data.data
        initToast({
          message: `${t(`notifications.${bonus.transaction_type}`)} ${bonus.amount} ${t('bonus.currency')}`,
          color: colors.success,
        })
        value.has_bonus = true
      },
    },
  ]
  const getCampaign = async () => {
    const { data } = await axios.get('/api/admin/campaign')
    profit.value = +data.data.find((item) => item.name === 'profit').value
  }
  onMounted(getCampaign)
</script>

<style lang="scss"></style>
