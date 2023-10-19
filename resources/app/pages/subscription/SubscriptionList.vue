<template>
  <va-inner-loading :loading="!subscriptions">
      <nav class="cent-nt">
          <h3>Мои подписки</h3>
      </nav>

    <div class="subscription">

        <div class="cards-container">
            <va-card
                class="card-subsc"
                v-for="subscription in subscriptions"
                :key="subscription.id"
            >
                <h3 class="block">
                    {{ subscription.product.category.name }}
                </h3>
                <div class="content">
                    <div class="inner">
                        <h3 class="title mb-2">{{ t('subscriptions.tariff') }}: {{ subscription.product.name }}</h3>
                        <div class="mb-1">{{ t('subscriptions.account_not_set') }}</div>
                        <div>
                            {{ t('subscriptions.expires_at') }}:
                            {{moment(subscription.expires_at).format(`DD.MM.YYYY ${t('utils.at')} HH:mm:ss`) }}
                        </div>
                    </div>

                    <va-button :to="`/subscriptions/manage/${subscription.id}`">
                        <i class="fa fa-fw fa-pen" />
                        {{ t('subscriptions.configure_btn') }}
                    </va-button>
                </div>
            </va-card>
      </div>

        <div class="faq-container">
            <Faq category-id="2"/>
        </div>
    </div>
  </va-inner-loading>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import moment from 'moment'
import { useI18n } from 'vue-i18n';
import Faq from '../../components/faq/Faq.vue';
const { t } = useI18n()
const subscriptions = ref()

const getSubscriptions = async () => {
  const { data } = await axios.get('/api/subscription')
  subscriptions.value = data.data
}

onMounted(getSubscriptions)
</script>

<style lang="scss">
.subscription__info {
  display: flex;
  justify-content: space-between;
}
</style>
