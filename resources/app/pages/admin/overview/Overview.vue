<template>
    <div class="cent-nt over-ad">
        <h3>Обзор</h3>
    </div>
  <va-inner-loading :loading="!overview">
    <div v-if="overview" class="overview">

        <div class="top-container">
            <va-card>
                <div class="inner">
                    <span>{{ overview.subscribed_count || 0 }}</span>
                    <span> / </span>
                    <span>{{ overview.user_count - overview.subscribed_count || 0 }}</span>
                    <span> / </span>
                    <span>{{ overview.user_count || 0 }}</span>
                </div>
                <h3>{{ t('overview.users') }}</h3>
            </va-card>

            <va-card>
                <div class="inner">
                    <span>{{ Number(overview.user_balances).toFixed(2) }} PX</span>
                </div>
                <h3>{{ t('overview.user_balances') }}</h3>
            </va-card>

            <va-card>
                <div class="inner">
                    <span>{{ overview.westwallet_balance }} USDT</span>
                </div>
                <h3>{{ t('overview.westwallet_balance') }}</h3>
            </va-card>

            <va-card>
                <div class="inner">
                    <span>{{ overview.withdraw_amount }} PX</span>
                </div>
                <h3>{{ t('overview.withdraw_amount') }}</h3>
            </va-card>

            <va-card>
                <div class="inner">
                    <span>{{ overview.transfer_amount }} PX</span>
                </div>
                <h3>{{ t('overview.transfer_amount') }}</h3>
            </va-card>

            <va-card>
                <div class="inner">
                    <span>{{ overview.bonus_amount }} PX</span>
                </div>
                <h3>{{ t('overview.bonus_amount') }}</h3>
            </va-card>

            <va-card>
                <div class="inner">
                    <span>54</span>
                    <span> / </span>
                    <span>0</span>
                    <span> / </span>
                    <span>54</span>
                </div>
                <h3>{{ t('overview.subscriptions') }}</h3>
            </va-card>

            <va-card>
                <div class="inner">
                    <span>0</span>
                    <span> / </span>
                    <span>0</span>
                    <span> / </span>
                    <span>5</span>
                    <span> / </span>
                    <span>{{ overview?.tickets?.length || 0 }}</span>
                </div>
                <h3>{{ t('overview.tickets') }}</h3>
            </va-card>
        </div>

        <va-card class="table-container">
            <h3>{{ t('overview.top5_sellers') }}</h3>
            <va-card-content>
                <div class="table-wrapper">
                    <table class="va-table va-data-table__table striped hoverable">
                        <thead>
                        <tr>
                            <th>{{ t('tables.headings.name') }}</th>
                            <th>{{ t('tables.headings.partner_quantity') }}</th>
                            <th>{{ t('tables.headings.amount') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="seller in overview.sellers" :key="seller.user.id">
                            <td>
                                <router-link :to="`/profile/${seller.user.id}`">
                                    {{ seller.user.username }}
                                </router-link>
                            </td>
                            <td>{{ seller.partners_count }}</td>
                            <td>{{ seller.value }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </va-card-content>
        </va-card>
    </div>
  </va-inner-loading>
</template>

<script setup>
  import { onMounted, ref } from 'vue'
  import axios from 'axios'
  import { useColors } from 'vuestic-ui'
  import { useI18n } from 'vue-i18n'

  const { colors } = useColors()
  const { t } = useI18n()
  const overview = ref()

  const getOverview = async () => {
    const { data } = await axios.get('/api/admin/overview')
    overview.value = data
  }

  onMounted(getOverview)
</script>

<style lang="scss">
  .row-equal .flex {
    .va-card {
      height: 100%;
    }
  }

  .overview {
    .va-card {
      margin-bottom: 0 !important;
      &__title {
        display: flex;
        justify-content: space-between;
      }
    }
    .va-data-table__table {
      width: 100%;
    }
  }
</style>
