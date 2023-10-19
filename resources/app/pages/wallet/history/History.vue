<template>
  <div class="cent-nt">
    <h3>{{ t('pages.history') }}</h3>
  </div>
  <va-card class="history table">
    <div class="inner">
      <ResourceTable :columns="columns" endpoint="/api/history" />
    </div>
  </va-card>
</template>

<script setup>
  import ResourceTable from '../../../components/tables/ResourceTable.vue'
  import { useI18n } from 'vue-i18n'
  const { t } = useI18n()
  const columns = [
    { key: 'transaction_type', label: 'transaction_type', sortable: true },
    { key: 'status', sortable: true },
    { key: 'amount', sortable: true },
    { key: 'updated_at', sortable: true },
  ]
</script>
