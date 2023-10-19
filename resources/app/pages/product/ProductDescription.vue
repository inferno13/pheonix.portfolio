<template>

    <div class="bg-nt prd-descr">
        <span>
            <router-link to="/products">
                <i class="fa fa-fw fa-arrow-left" />
            </router-link>
            <h3>Описание продукта</h3>
        </span>

        <span>
                <router-link to="/products">
                    Продукты
                </router-link>
              <span class="slash">/</span>
              Описание
          </span>
    </div>

  <div class="product-description">
      <va-inner-loading :loading="!product">
          <va-card v-if="product">
              <h3>{{ product.category.name }} {{ product.name }}</h3>
              <va-card-content>{{ product.description }}</va-card-content>
          </va-card>
      </va-inner-loading>
  </div>
</template>

<script setup>
  import { ref, onMounted } from 'vue'
  import axios from 'axios'
  import { useRoute } from 'vue-router'
  const { params } = useRoute()
  const { id } = params
  const product = ref()

  const getProduct = async () => {
    const { data } = await axios.get(`/api/product/${id}`)
    product.value = data.data
  }
  onMounted(getProduct)
</script>
