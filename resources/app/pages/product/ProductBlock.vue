<template>
  <va-card class="product-block" :class="props.product.name === 'professional' ? 'product-block--pro' : ''">
    <h4>
      {{ t(`products.${props.product.name}`) }}
      <div v-if="props.product.name === 'professional'" class="product-hit">
        <div class="product-hit-word">{{ t('products.hit') }}</div>
      </div>
    </h4>
    <div class="price">{{ props.product.price }} USDT</div>
    <div class="va-table-responsive">
      <table class="va-table va-table--striped va-table--hoverable">
        <tbody>
          <tr>
            <td>{{ t('list_items.license') }}</td>
            <td>{{ props.product.license }} {{ t('utils.items') }}</td>
          </tr>
          <tr>
            <td>{{ t('list_items.currency') }}</td>
            <td>
              <check-cancel :value="props.product.currency" />
            </td>
          </tr>
          <tr>
            <td>{{ t('list_items.crypto') }}</td>
            <td>
              <check-cancel :value="props.product.crypto" />
            </td>
          </tr>
          <tr>
            <td>{{ t('list_items.index') }}</td>
            <td>
              <check-cancel :value="props.product.index" />
            </td>
          </tr>
          <tr>
            <td>{{ t('list_items.period') }}</td>
            <td>{{ props.product.period }} {{ t(`utils.months`) }}</td>
          </tr>
          <tr>
            <td>{{ t('list_items.tutorial') }}</td>
            <td>
              <check-cancel :value="props.product.tutorial" />
            </td>
          </tr>
          <tr>
            <td>{{ t('list_items.tech_support') }}</td>
            <td>
              <check-cancel :value="props.product.tech_support" />
            </td>
          </tr>
          <tr>
            <td>{{ t('list_items.marketing') }}</td>
            <td>
              {{ props.product.marketing }} {{ props.product.marketing > 1 ? t(`utils.levels`) : t(`utils.level`) }}
            </td>
          </tr>
          <tr>
            <td>{{ t('list_items.bonus') }}</td>
            <td>
              <check-cancel :value="props.product.bonus" />
            </td>
          </tr>
          <tr>
            <td>{{ t('list_items.pull') }}</td>
            <td>
              <check-cancel :value="props.product.pull" />
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <footer>
      <button class="light-purple-button dark submit" @click="submit">
        {{ t('products.submit') }}
      </button>
    </footer>
  </va-card>
  <div class="product-details">
    <router-link :to="`/products/description/${props.product.id}`">{{ t('products.more') }}</router-link>
  </div>
</template>

<script setup>
  import { defineProps } from 'vue'
  import axios from 'axios'
  import { useI18n } from 'vue-i18n'
  import CheckCancel from '../../components/icons/CheckCancel.vue'
  const { t } = useI18n()

  const props = defineProps({
    product: {
      type: Object,
      default: () => {
        return {}
      },
    },
  })

  const submit = async () => {
    await axios.get(`/api/product/buy/${props.product.id}`)
  }
</script>

<style lang="scss">
  .product-block {
    .material-icons {
      display: block;
      font-weight: bold;
    }
    .submit {
      text-transform: uppercase;
    }
  }
  .product-details {
    margin-top: 1em;
    text-align: center;

    a {
      color: var(--bs-purple);
    }
  }
</style>
