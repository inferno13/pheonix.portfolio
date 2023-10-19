<template>
  <div class="withdraw">

      <div class="cent-nt">
          <h3>{{ t('withdraw.title') }}</h3>
      </div>

    <header>
        <va-card>
            <va-form tag="form" @submit.prevent="withdraw">
                <div class="input-group">
                    <label>{{ t('withdraw.address') }}</label>
                    <va-input
                        v-model="form.address"
                        :placeholder="t('withdraw.address_placeholder')"
                        :error-messages="form.errors.get('address')"
                        :error="form.errors.has('address')"
                    />
                </div>
                <div class="input-group">
                    <label>{{ t('withdraw.amount') }}</label>
                    <va-input
                        v-model="form.amount"
                        :placeholder="`100`"
                        :error-messages="form.errors.get('amount')"
                        :error="form.errors.has('amount')"
                    />
                </div>
                <div class="input-group">
                    <label>{{ t('withdraw.code') }}</label>
                    <div class="code__div">
                        <va-input
                                v-model="form.code"
                                :placeholder="`Код из почтового сообщения`"
                                :error-messages="form.errors.get('code')"
                                :error="form.errors.has('code')"
                        /><button @click="withdrawCode" class="va-input__content__input code__button" type="button">{{ t('withdraw.code_submit') }}</button>
                    </div>
                </div>
                <button class="light-purple-button dark" type="submit">{{ t('withdraw.submit') }}</button>
            </va-form>
        </va-card>

      <div class="faq-container inner">
        <Faq :category-id="1" />
      </div>
    </header>

      <h4 class="block-title">
          {{ t('withdraw.withdraw_history') }}
      </h4>

      <va-card class="table-container">
          <div class="inner">
              <ResourceTable :columns="columns" :endpoint="endpoint" />
          </div>
      </va-card>
  </div>
</template>

<script setup lang="ts">
  import { Form } from 'vform'
  import { ref } from 'vue'
  import { useI18n } from 'vue-i18n'
  import ResourceTable from '../../../components/tables/ResourceTable.vue'
  import Faq from '../../../components/faq/Faq.vue'

  import axios from 'axios'

  const endpoint = '/api/withdraw'
  const columns = [
    { key: 'status' },
    { key: 'deposit_method', label: 'crypto_currency', name: 'crypto_currency' },
    { key: 'deposit_method', label: 'crypto_amount', name: 'crypto_amount' },
    { key: 'address' },
    { key: 'created_at' },
  ]
  const { t } = useI18n()
  const form = ref(
    new Form({
      address: '',
      amount: '',
    }),
  )

  function withdraw() {
    form.value.post(endpoint).then((data) => {
      console.log(data)
    })
  }

  const withdrawCode = async () => {
      const { data } = await axios.get('/api/withdraw')
      console.log(data)
  }
</script>

