<template>
    <div class="bg-nt ad-categ">
        <h3>Линейки продуктов</h3>
    </div>
  <va-inner-loading :loading="!categories">
    <div v-if="categories" class="categories-admin">
      <div v-for="category in categories" :key="category.id" class="row">
          <va-card>
              <!--            <va-card-title>{{ category.name }}</va-card-title>-->
              <va-card-content>
                  <ResourceTable :schema="schema" :crudable="true" :columns="columns" endpoint="/api/admin/category" />
              </va-card-content>
          </va-card>
      </div>
    </div>
  </va-inner-loading>
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
  ]

  const schema = ref([
    {
      name: 'category',
      fields: {
        name: {
          type: 'input',
        },
        description: {
          type: 'input',
        },
      },
    },
  ])

  const getCategories = async () => {
    const { data } = await axios.get('/api/admin/category')
    categories.value = data.data
  }
  onMounted(getCategories)
</script>

<style>
    .categories-admin{
        width: 80%;
        margin: 2em auto;
    }
    .bg-nt.ad-categ{
        padding: 1.75em 10%;
    }

    @media screen and (max-width: 800px){
        .categories-admin{
            width: 95%;
        }
        .bg-nt.ad-categ{
            padding: 1.5em 2.5%;
        }
    }
</style>
