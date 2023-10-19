<template>
  <div class="deposit">
    <div class="cent-nt">
      <h3>Пополнение баланса</h3>
    </div>

    <va-inner-loading :loading="!depositMethods">
      <h4 class="block-title">Криптовалюты</h4>
      <div v-if="depositMethods" class="deposit-crypto-methods">
        <va-card v-for="dm in depositMethods" :key="dm.id" :to="`deposit/method/${dm.id}`" class="deposit-card-crypto">
          <img :src="`${dm.logo}`" alt="" />
          <span>{{ dm.name }}</span>
        </va-card>
      </div>
    </va-inner-loading>

    <h4 class="block-title">История пополнений</h4>
    <div class="select-deposit">
      <va-card>
        <div class="inner">
          <ResourceTable :columns="columns" endpoint="/api/deposit" />
        </div>
      </va-card>
    </div>
  </div>
</template>

<script setup>
  import { onMounted, ref } from 'vue'
  import axios from 'axios'
  import { useI18n } from 'vue-i18n'
  import ResourceTable from '../../../components/tables/ResourceTable.vue'

  const columns = [
    { key: 'status' },
    { key: 'transaction_type', label: 'payment_method', name: 'payment_method' },
    { key: 'deposit_method', label: 'crypto_currency', name: 'crypto_currency' },
    { key: 'deposit_method', label: 'crypto_amount', name: 'crypto_amount' },
    { key: 'created_at' },
  ]
  const { t } = useI18n()
  const depositMethods = ref()
  const getDepositMethods = async () => {
    const { data } = await axios.get('/api/deposit_method')
    depositMethods.value = data.data
  }

  onMounted(getDepositMethods)
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
