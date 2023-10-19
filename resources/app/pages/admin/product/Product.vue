<template>
    <div class="bg-nt ad-prdct">
        <h3>Продукты</h3>
    </div>
  <div class="admin-product">
      <va-card>
          <va-card-content>
              <ResourceTable
                  :schema="schema"
                  :crudable="true"
                  :columns="columns"
                  endpoint="/api/admin/product"
              />
          </va-card-content>
      </va-card>
  </div>
</template>

<script setup>
  import { ref, onMounted } from 'vue'
  import { useI18n } from 'vue-i18n'
  import axios from 'axios'
  import ResourceTable from '../../../components/tables/ResourceTable.vue'

  const { t } = useI18n()
  const categories = ref()

  const columns = [
    { key: 'name', sortable: true },
    { key: 'description', sortable: true },
    { key: 'price', sortable: true },
    { key: 'license', sortable: true },
    { key: 'currency', name: 'has_currency', label: 'has_currency', sortable: true },
    { key: 'crypto', sortable: true },
    { key: 'period', sortable: true },
    { key: 'tutorial', sortable: true },
    { key: 'tech_support', sortable: true },
    { key: 'bonus', sortable: true },
    { key: 'pull', sortable: true },
  ]

  const schema = ref([
    {
      name: 'product',
      fields: {
        name: {
          type: 'input',
        },
        description: {
          type: 'input',
        },
        download_link: {
          type: 'input',
        },
        version: {
          type: 'input',
        },
        price: {
          type: 'input',
        },
        license: {
          type: 'input',
        },
        currency: {
          type: 'switch',
          value: false,
        },
        crypto: {
          type: 'switch',
          value: false,
        },
        period: {
          type: 'input',
        },
        tutorial: {
          type: 'switch',
          value: true,
        },
        tech_support: {
          type: 'switch',
          value: true,
        },
        marketing: {
          type: 'input',
          value: 10,
        },
        bonus: {
          type: 'switch',
          value: true,
        },
        pull: {
          type: 'switch',
          value: true,
        },
      },
    },
  ])

  const getCategories = async () => {
    const { data } = await axios.get('/api/admin/product')
    categories.value = data.data
  }
  onMounted(getCategories)
</script>

<style>
    .admin-product .va-card__content{
        width: 100%;
        overflow-x: scroll;
    }

    .admin-product{
        width: 90%;
        margin: 2em auto 2em;
    }
    .bg-nt.ad-prdct{
        padding: 1.75em 5%;
    }

    @media (max-width: 1000px){
        .admin-product{
            width: 95%;
        }
        .bg-nt.ad-prdct{
            padding: 1.75em 2.5%;
        }
    }
</style>
