<template>
    <div class="bg-nt sub-list-ad">
        <h3>Подписки</h3>
    </div>
  <div class="subscriptions">
      <va-card>
          <va-card-content>
              <ResourceTable :columns="columns" endpoint="/api/admin/subscriptions" />
          </va-card-content>
      </va-card>
  </div>
</template>

<script setup>
  import ResourceTable from '../../../components/tables/ResourceTable.vue'
  const columns = [
    { key: 'user' },
    { key: 'product.name', label: 'product_name', name: 'product_name' },
    { key: 'amount' },
    { key: 'product_key' },
    { key: 'expires_at' },
  ]
</script>

<style>
    .subscriptions .va-card__content{
        width: 100%;
        overflow-x: scroll;
    }

    .subscriptions{
        width: 90%;
        margin: 2em auto 2em;
    }
    .bg-nt.sub-list-ad{
        padding: 1.75em 5%;
    }

    @media (max-width: 1000px){
        .subscriptions{
            width: 95%;
        }
        .bg-nt.sub-list-ad{
            padding: 1.75em 2.5%;
        }
    }
</style>
