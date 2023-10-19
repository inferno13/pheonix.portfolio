<template>
  <div class="row row-equal">
    <div class="flex xl12 xs12 lg12">
      <!--top 4 blocks with info-->
      <div class="top-info-list">
        <va-inner-loading class="top-card" :loading="partnersCount === null || partnersCount === undefined">
          <va-card class="inner">
            <div class="icon-container">
              <i class="fa fa-fw fa-users"></i>
            </div>
            <h3 :style="{ color: colors.white }">{{ partnersCount || 0 }}</h3>
            <p>{{ t('dashboard.partners') }}</p>
          </va-card>
        </va-inner-loading>
        <va-inner-loading class="top-card" :loading="activationRate === null || activationRate === undefined">
          <va-card class="inner">
            <div class="icon-container">
              <i class="fa fa-fw fa-percent"></i>
            </div>
            <h3 :style="{ color: colors.white }">{{ activationRate || 0 }}%</h3>
            <p>{{ t('dashboard.activation_percentage') }}</p>
          </va-card>
        </va-inner-loading>
        <va-inner-loading class="top-card" :loading="totalAccrued === null || totalAccrued === undefined">
          <va-card class="inner">
            <div class="icon-container">
              <i class="fa fa-fw fa-chart-line"></i>
            </div>
            <h3 :style="{ color: colors.white }">{{ totalAccrued || 0 }} PX</h3>
            <p>{{ t('dashboard.total_accrued') }}</p>
          </va-card>
        </va-inner-loading>
        <va-inner-loading class="top-card" :loading="user.balance === null || user.balance === undefined">
          <va-card class="inner">
            <div class="icon-container">
              <i class="fa fa-fw fa-wallet"></i>
            </div>
            <h3 :style="{ color: colors.white }">{{ Number(user.balance).toFixed(3) }} PX</h3>
            <p>{{ t('dashboard.current_balance') }}</p>
          </va-card>
        </va-inner-loading>
      </div>

      <div class="tables-container">
        <div class="table-patners">
          <va-card class="flex mb-4">
            <va-card-title>
              <i class="fa fa-fw fa-users-cog"></i>
              {{ t('dashboard.partners') }}
            </va-card-title>
            <va-card-content>
              <resource-table
                :no-data="t('tables.is_empty.partners')"
                :selectable="false"
                :creatable="false"
                endpoint="/api/partner"
                :columns="partnerColumns"
                @data:fetched="onPartnersFetched"
              />
            </va-card-content>
          </va-card>
        </div>

        <div class="table-pays">
          <va-card class="flex mb-4">
            <va-card-title>
              <i class="fa fa-fw fa-money-bill-wave"></i>
              {{ t('dashboard.accrual_history') }}
            </va-card-title>
            <va-card-content>
              <resource-table
                :no-data="t('tables.is_empty.accrual_history')"
                :columns="marketingTransactionColumns"
                endpoint="/api/marketing_transaction"
                @data:fetched="onTransactionsFetched"
              />
            </va-card-content>
          </va-card>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
  import { ref } from 'vue'
  import { useI18n } from 'vue-i18n'
  import { VaCard, VaCardContent, VaCardTitle, useColors } from 'vuestic-ui'
  import { useGlobalStore } from '../../stores/global-store'
  import { storeToRefs } from 'pinia'
  import ResourceTable from '../../components/tables/ResourceTable.vue'

  const GlobalStore = useGlobalStore()
  const { t } = useI18n()
  const { colors } = useColors()
  const { user } = storeToRefs(GlobalStore)

  const partnersCount = ref()
  const transactions = ref([])
  const activationRate = ref()
  const totalAccrued = ref()
  const partnerColumns = [
    { key: 'partner.avatar', label: 'avatar', name: 'avatar' },
    { key: 'partner.username', label: 'partner_username', name: 'partner_username', sortable: true },
    { key: 'count', label: 'count_partners', name: 'count_partners', sortable: true },
  ]

  const marketingTransactionColumns = [
    { key: 'type', name: 'accrual', label: 'accrual', sortable: true },
    { key: 'status', sortable: true },
    { key: 'amount', sortable: true },
    { key: 'created_at', sortable: true },
  ]

  const onTransactionsFetched = (_transactions) => {
    transactions.value = _transactions
    totalAccrued.value = _transactions.data.reduce((acc, cur) => cur.amount + acc, 0)
  }

  const onPartnersFetched = (partners) => {
    activationRate.value = (partners.data.filter((p) => p.activation_date).length / partners.data.length) * 100
    partnersCount.value = partners.data.length
  }
</script>

<style lang="scss">
  .table-wrapper {
    overflow: auto;
  }

  .va-table {
    width: 100%;
  }
</style>
