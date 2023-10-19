<template>
  <PageHeader>
    <template #actions>
      <AddButton @button:click="addUser" />
    </template>
  </PageHeader>
  <div class="admin-users">
    <va-card>
      <va-card-content class="table-container">
        <div class="inner">
          <ResourceTable
            :custom-actions="customActions"
            :schema="schema"
            :columns="columns"
            endpoint="/api/admin/user"
          />
        </div>
      </va-card-content>
    </va-card>
  </div>
  <CreateModal :form="form" :show="showModal" :schema="schema" @modal:toggle="onToggleModal" @form:submit="onSubmit" />
</template>

<script setup>
  import { ref } from 'vue'
  import { Form } from 'vform'
  import { useToast, useColors } from 'vuestic-ui'
  import { useI18n } from 'vue-i18n'
  import axios from 'axios'
  import { storeToRefs } from 'pinia'
  import router from '../../../router'
  import { useGlobalStore } from '../../../stores/global-store'
  import PageHeader from '../../../components/page-header/PageHeader.vue'
  import ResourceTable from '../../../components/tables/ResourceTable.vue'
  import CreateModal from '../../../components/modals/CreateModal.vue'
  import AddButton from '../../../components/buttons/AddButton.vue'

  const GlobalStore = useGlobalStore()
  const { user } = storeToRefs(GlobalStore)
  const { setFakeUser, getUser } = GlobalStore
  const showModal = ref(false)
  const { init: initToast } = useToast()
  const { colors } = useColors()

  const columns = [
    { key: 'id', sortable: true },
    { key: 'id', label: 'user_nameplate', name: 'user_nameplate' },
    { key: 'email' },
    { key: 'balance' },
    { key: 'roles' },
    { key: 'created_at', label: 'sign_up_date', name: 'sign_up_date' },
  ]

  const customActions = [
    {
      icon: 'edit',
      isDisabled: () => false,
      click: (data) => {
        router.push(`/profile/${data.id}`)
      },
    },
    {
      icon: 'meeting_room',
      isDisabled: () => false,
      click: async (data) => {
        await axios.get(`/api/switch-user/switch/${data.id}`)
        await getUser()
        router.push(`/profile/${data.id}`)
        setFakeUser(true)
      },
    },
  ]

  const onSubmit = async () => {
    const { data } = await form.value.post('/api/admin/user')
    const { password } = data
    initToast({ message: `${t('users.temp_password')}: ${password}`, color: colors.info })
    showModal.value = false
  }

  const { t } = useI18n()

  const addUser = () => {
    showModal.value = true
  }

  const onToggleModal = (value) => {
    showModal.value = value
  }

  const form = ref(
    new Form({
      username: '',
      surname: '',
      name: '',
      role: user.value.roles[0],
    }),
  )

  const schema = ref([
    {
      name: 'username',
      showDivider: false,
      fields: {
        username: {
          type: 'input',
          placeholder: 'username',
        },
        role: {
          type: 'select',
          options: user.value.roles,
        },
        email: {
          type: 'input',
          placeholder: 'email',
        },
      },
    },
  ])
</script>

<style>
  .admin-users .inner {
    overflow-x: scroll !important;
  }
</style>
