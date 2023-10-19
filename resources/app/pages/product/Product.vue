<template>
  <va-inner-loading :loading="!products">
    <div v-if="products" class="product">
      <div class="row">
        <div class="flex xs12">
          <div class="cent-nt">
            <h3>{{ t('pages.products') }}</h3>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="flex xs12">
          <div class="product-list">
            <div class="row">
              <div v-for="product in products" :key="product.id" class="flex xs12 sm4 product-container">
                <ProductBlock :product="product" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </va-inner-loading>
</template>

<script setup>
  import { onMounted, ref } from 'vue'
  import { useI18n } from 'vue-i18n'
  import axios from 'axios'
  import ProductBlock from './ProductBlock.vue'

  const { t } = useI18n()

  const products = ref()

  const getProducts = async () => {
    const { data } = await axios.get('/api/product')
    products.value = data.data
  }
  onMounted(getProducts)
</script>
