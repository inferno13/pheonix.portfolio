<template>
  <va-inner-loading :loading="!subscription">
    <nav class="bg-nt sub-red">
          <span>
              <router-link to="/subscriptions">
                  <i class="fa fa-fw fa-arrow-left" />
              </router-link>
              <h3>Управление подпиской</h3>
          </span>

          <span>
              <router-link to="/subscriptions">
                  Подписки
              </router-link>
              <span class="slash">/</span>
              Управление
          </span>
    </nav>

    <div v-if="subscription" class="subscription-redact">
      <div class="cards-container">
        <va-card>
          <div class="left">
            <h3>{{ subscription.status === "completed" ? "Активирован" : "Не активирован" }}</h3>
            <div>{{ t('subscriptions.current_status') }}</div>
          </div>
          <i class="fa fa-fw fa-key" />
        </va-card>
        <va-card>
          <div class="left">
            <h3><Date :date="subscription.expires_at" /></h3>
            <div>{{ t('subscriptions.expiration_date') }}</div>
          </div>
          <i class="fa fa-fw fa-calendar" />
        </va-card>
        <va-card>
          <div class="left">
            <h3>12345678</h3>
            <div>{{ t('subscriptions.account_number') }}</div>
          </div>
          <i class="fa fa-fw fa-star" />
        </va-card>
      </div>

      <div class="footer">
        <va-card>
          <h3>{{ t('subscriptions.product_key') }}</h3>
          <va-card-content>
            <Clipboard :message="subscription.product_key" />
          </va-card-content>
        </va-card>
        <div class="faq-container">
          <Faq category-id="3" />
        </div>
      </div>
    </div>
  </va-inner-loading>
</template>

<script setup>
  import { onMounted, ref } from 'vue'
  import { useRoute } from 'vue-router'
  import axios from 'axios'
  import { useI18n } from 'vue-i18n'
  import Faq from '../../components/faq/Faq.vue'
  import Clipboard from '../../components/clipboard/Clipboard.vue'
  import Date from '../../components/date/Date.vue'

  const { t } = useI18n()
  const { params } = useRoute()
  const { id } = params
  const subscription = ref()

  const getSubscription = async () => {
    const { data } = await axios.get(`/api/subscription/${id}`)
    subscription.value = data.data
  }

  onMounted(getSubscription)
</script>
