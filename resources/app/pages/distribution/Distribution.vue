<template>
  <va-inner-loading :loading="!distributions">
      <div class="bg-nt distr">
          <span>
                <router-link to="/products">
                    <i class="fa fa-fw fa-arrow-left" />
                </router-link>
                <h3>Дистрибутивы</h3>
          </span>

          <span>
              <router-link to="/products">
                  Продукты
              </router-link>
              <span class="slash">/</span>
              Дистрибутивы
          </span>
      </div>

    <div v-if="distributions" class="distributions">

        <div
            v-for="distribution in Object.keys(distributions)"
            :key="distribution"
            class="inner-container"
        >
            <div class="title-main">
                <h3>{{ distribution }}</h3>
                <div class="line" />
            </div>

            <div
                v-for="product in Object.keys(distributions[distribution])"
                :key="product"
                class="cards-container"
            >
                <va-card>
                    <h3>{{ distribution }} {{ product }}</h3>
                    <div class="text">
                        {{ t('distributions.current_version') }}
                        {{ distributions[distribution][product].version }}
                    </div>
                    <va-button :href="distributions[distribution][product].downloadLink">
                        <i class="fa fa-fw fa-download"></i>
                        {{ t('distributions.download') }}
                    </va-button>
                </va-card>
            </div>
        </div>
    </div>
  </va-inner-loading>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import axios from 'axios'
import { useI18n } from 'vue-i18n'

const { t } = useI18n()
const distributions = ref()

const getCategories = async () => {
  const { data } = await axios.get('/api/subscription')
  distributions.value = data.data.reduce((acc, cur) => {
    const distributionName = cur.product.category.name
    const productName = cur.product.name
    const downloadLink = cur.product.download_link
    const version = cur.product.version
    if (distributionName) {
      acc[distributionName] = {}
    }
    acc[distributionName][productName] = { downloadLink, version }
    return acc
  }, {})
}
onMounted(getCategories)
</script>
