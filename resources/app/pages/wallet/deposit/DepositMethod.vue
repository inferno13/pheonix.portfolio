<template>
  <div class="deposit method">
      <nav class="bg-nt">
          <span>
              <router-link to="/wallet/deposit">
                  <i class="fa fa-fw fa-arrow-left" />
              </router-link>
              <h3>Пополнение баланса</h3>
          </span>

          <span>
              <router-link to="/wallet/deposit">
                  Пополнение
              </router-link>
              <span class="slash">/</span>
              Криптовалюты
          </span>
      </nav>

    <va-inner-loading :loading="!depositMethod">
      <header v-if="depositMethod">
        <div class="quest">
          <h3>
            <i class="fa fa-fw fa-money-check" />
            {{ t('deposit.deposit') }}
          </h3>
          <table class="va-table va-table--striped va-table--hoverable">
            <tbody>
              <tr>
                <td>{{ t('tables.headings.coin') }}</td>
                <td :style="{ display: 'flex', justifyContent: 'flex-end' }">
                  <Nameplate :name="depositMethod.name" :image="depositMethod.logo" />
                </td>
              </tr>
              <tr>
                <td>{{ t('tables.headings.network') }}</td>
                <td>{{ depositMethod.network || '-' }}</td>
              </tr>
              <tr>
                <td>{{ t('tables.headings.confirmations') }}</td>
                <td>{{ depositMethod.confirmations || '-' }}</td>
              </tr>
              <tr>
                <td>{{ t('tables.headings.min_receive') }}</td>
                <td>{{ depositMethod.min_receive || '-' }} {{ depositMethod.ticker }}</td>
              </tr>
              <tr>
                <td>{{ t('tables.headings.fee') }}</td>
                <td>{{ depositMethod.fee || '-' }} {{ depositMethod.ticker }}</td>
              </tr>
            </tbody>
          </table>
          <button class="light-purple-button dark" @click="createDepositTransaction">
            {{ t('deposit.get_address') }}
          </button>
        </div>
        <div class="quest">
          <Faq category-id="1" />
        </div>
      </header>
    </va-inner-loading>
  </div>
</template>

<script setup>
  import axios from 'axios'
  import { useRoute } from 'vue-router'
  import { onMounted, ref } from 'vue'
  import { useI18n } from 'vue-i18n'
  import router from '../../../router'
  import Faq from '../../../components/faq/Faq.vue'
  import Nameplate from '../../../components/nameplates/Nameplate.vue'

  const { t } = useI18n()
  const { params } = useRoute()
  const { id } = params

  const depositMethod = ref()

  const getDepositTransaction = async () => {
    const { data } = await axios.get(`/api/deposit_method/${id}`)
    depositMethod.value = data.data
  }

  const createDepositTransaction = async () => {
    const { data } = await axios.post('/api/deposit/', { deposit_method_id: depositMethod.value.id })
    router.push(`/wallet/deposit/transaction/${data.data.id}`)
  }
  onMounted(getDepositTransaction)
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
