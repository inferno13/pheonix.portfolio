<template>
  <div class="deposit">
    <va-inner-loading :loading="!transaction">
      <div v-if="transaction" class="row">
        <div class="flex xs12 sm6">
          <va-card>
            <va-card-title>{{ t('deposit.deposit') }}</va-card-title>
            <va-card-content>
              <div class="va-table-responsive">
                <table class="va-table va-table--striped va-table--hoverable">
                  <tbody>
                    <tr>
                      <td>{{ t('tables.headings.status') }}</td>
                      <td><va-badge :text="t(`status.${transaction.status}`)" :color="getStatusColor(value)" /></td>
                    </tr>
                    <tr>
                      <td>{{ t('tables.headings.coin') }}</td>
                      <td>
                        <Nameplate :name="transaction.deposit_method.name" :image="transaction.deposit_method.logo" />
                      </td>
                    </tr>
                    <tr>
                      <td>{{ t('tables.headings.network') }}</td>
                      <td>{{ transaction.deposit_method.network }}</td>
                    </tr>
                    <tr>
                      <td>{{ t('tables.headings.confirmations') }}</td>
                      <td>{{ transaction.deposit_method.confirmations }}</td>
                    </tr>
                    <tr>
                      <td>{{ t('tables.headings.min_receive') }}</td>
                      <td>{{ transaction.deposit_method.min_receive }} {{ transaction.deposit_method.ticker }}</td>
                    </tr>
                    <tr>
                      <td>{{ t('tables.headings.fee') }}</td>
                      <td>{{ transaction.deposit_method.min_receive }}</td>
                    </tr>
                    <tr>
                      <td>{{ t('tables.headings.amount') }}</td>
                      <td>{{ transaction.amount }}</td>
                    </tr>
                    <tr>
                      <td>{{ t('tables.headings.address') }}</td>
                      <td>
                        <Clipboard :message="transaction.address" />
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </va-card-content>
          </va-card>
        </div>
        <div class="flex xs12 sm6">
          <Faq category-id="1" />
        </div>
      </div>
    </va-inner-loading>
  </div>
</template>

<script setup>
  import axios from 'axios'
  import { useRoute } from 'vue-router'
  import { onMounted, ref } from 'vue'
  import { useI18n } from 'vue-i18n'
  import Clipboard from '../../../components/clipboard/Clipboard.vue'
  import Faq from '../../../components/faq/Faq.vue'
  import Nameplate from '../../../components/nameplates/Nameplate.vue'
  import { getStatusColor } from '../../../utils'

  const { t } = useI18n()
  const { params } = useRoute()
  const { id } = params

  const transaction = ref()

  const getTransaction = async () => {
    const { data } = await axios.get(`/api/deposit/${id}`)
    transaction.value = data.data
  }
  onMounted(getTransaction)
</script>

<style lang="scss">
  .deposit {
    .va-card__content {
      text-align: center;
    }
    .va-card__image {
      height: 100px;
    }

    .table-wrapper {
      overflow: auto;
    }

    .va-table {
      width: 100%;
    }
  }
</style>
