<template>
  <PageHeader>
    <template #actions>
      <AddButton @button:click="addDeposit" />
    </template>
  </PageHeader>
  <div class="admin-deposit">
    <va-card>
      <va-card-content>
        <ResourceTable :columns="columns" :endpoint="endpoint" :custom-actions="customActions" />
      </va-card-content>
    </va-card>
  </div>
</template>

<script setup>
  import PageHeader from '../../../../components/page-header/PageHeader.vue'
  import ResourceTable from '../../../../components/tables/ResourceTable.vue'
  import AddButton from '../../../../components/buttons/AddButton.vue'

  const endpoint = '/api/admin/deposit'
  const columns = [
    { key: 'user', label: 'user_nameplate_attr', name: 'user_nameplate_attr' },
    { key: 'status' },
    { key: 'transaction_type', label: 'payment_method', name: 'payment_method' },
    { key: 'deposit_method', label: 'crypto_currency', name: 'crypto_currency' },
    { key: 'deposit_method', label: 'crypto_amount', name: 'crypto_amount' },
    { key: 'created_at' },
  ]
  const addDeposit = () => {
    alert('Добавить пополнение')
  }
  const customActions = [
    {
      icon: 'edit',
      isDisabled: () => false,
      click: (data) => {
        alert('Изменить пополнение')
      },
    },
  ]
</script>

<style>
  .admin-deposit .va-card__content {
    width: 100%;
    overflow-x: scroll;
  }
</style>
