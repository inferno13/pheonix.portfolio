<template>
  <PageHeader>
    <template #actions>
      <AddButton @button:click="addOperation" />
    </template>
  </PageHeader>
  <Content>
    <va-card>
      <ResourceTable :custom-actions="customActions" :endpoint="endpoint" :columns="columns" />
    </va-card>
  </Content>
</template>

<script setup>
  import PageHeader from '../../../../components/page-header/PageHeader.vue'
  import AddButton from '../../../../components/buttons/AddButton.vue'
  import Content from '../../../../components/content/Content.vue'
  import ResourceTable from '../../../../components/tables/ResourceTable.vue'

  const endpoint = '/api/admin/all_transactions'
  const columns = [
    { key: 'user', label: 'user_nameplate_attr', name: 'user_nameplate_attr' },
    { key: 'status' },
    { key: 'transaction_type', label: 'name', name: 'type' },
    { key: 'deposit_method', label: 'crypto_amount', name: 'crypto_amount' },
    { key: 'created_at' },
  ]

  const customActions = [
    {
      icon: 'more_horiz',
      isDisabled: () => false,
      click: () => {
        alert('Меню')
      },
    },
  ]

  const addOperation = () => {
    alert('Добавить операцию')
  }
</script>
