<template>
  <div class="Campaign">
    <PageHeader />
    <Content>
      <ResourceForm v-if="form" :form="form" :schema="schema" @form:submit="onSubmit" />
    </Content>
  </div>
</template>

<script setup>
  import { ref, onMounted } from 'vue'
  import { Form } from 'vform'
  import axios from 'axios'
  import Content from '../../../components/content/Content.vue'
  import PageHeader from '../../../components/page-header/PageHeader.vue'
  import ResourceForm from '../../../components/forms/ResourceForm.vue'

  const form = ref()
  const schema = ref([
    {
      name: 'marketing',
      showDivider: true,
      fields: {
        first_partners_count_target: {
          type: 'input',
          placeholder: 'first_partners_count_target',
        },
        second_partners_count_target: {
          type: 'input',
          placeholder: 'second_partners_count_target',
        },
        first_pull_target: {
          type: 'input',
          placeholder: 'first_pull_target',
        },
        second_pull_target: {
          type: 'input',
          placeholder: 'second_pull_target',
        },
        first_and_second_pull_target: {
          type: 'input',
          placeholder: 'first_and_second_pull_target',
        },
      },
    },
    {
      name: 'profit',
      showDivider: true,
      fields: {
        profit: {
          type: 'input',
          placeholder: 'profit',
        },
        pull_1: {
          type: 'input',
          placeholder: 'pull_2',
        },
        pull_2: {
          type: 'input',
          placeholder: 'pull_2',
        },
        pull_3: {
          type: 'input',
          placeholder: 'pull_3',
        },
      },
    },
    {
      name: 'quick_bonus',
      showDivider: true,
      fields: {
        quick_bonus_value_target: {
          type: 'input',
          placeholder: 'quick_bonus_value_target',
        },
        quick_bonus_value_time: {
          type: 'input',
          placeholder: 'quick_bonus_value_time',
        },
      },
    },
    {
      name: 'levels',
      showDivider: true,
      fields: [...Array(10).keys()].reduce((acc, cur) => {
        const level = `level_${cur + 1}`
        acc[level] = { type: 'input', placeholder: level }
        return acc
      }, {}),
    },
  ])

  const setFormValues = (data) => {
    const campaign = data.reduce((acc, cur) => {
      acc[cur.name] = cur.value
      return acc
    }, {})
    form.value = new Form({
      ...campaign,
    })
  }

  const onSubmit = async () => {
    debugger
    const { data } = await form.value.post('/api/admin/campaign')
    debugger
    setFormValues(data.data)
  }

  const getCampaign = async () => {
    const { data } = await axios.get('/api/admin/campaign')
    setFormValues(data.data)
  }
  onMounted(getCampaign)
</script>
