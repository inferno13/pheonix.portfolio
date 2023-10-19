<template>
  <va-inner-loading :loading="!dataFetched">
    <div class="line partners">
      <div class="cent-nt">
        <h3>{{ t('pages.line') }}</h3>
      </div>

      <va-card class="levels">
        <h3>
          <i class="fa fa-fw fa-level-up"></i>
          {{ t('network.levels') }}
        </h3>

        <va-tabs v-model="currentLevel">
          <template #tabs>
            <va-tab v-for="tab in [...Array(levels).keys()]" :key="tab" :disabled="tab + 1 > maxLevel">
              <va-icon v-if="tab + 1 > maxLevel" class="mr-2" name="lock" /><span
                >{{ t('network.level') }} {{ tab + 1 }}</span
              >
            </va-tab>
          </template>
        </va-tabs>
      </va-card>
      <va-card v-if="chartData" class="chart-widget line">
        <h3>
          <i class="fa fa-fw fa-line-chart"></i>
          {{ t('network.chart') }} график
        </h3>
        <div class="chart-overflow">
          <va-chart :data="chartData" type="line" />
        </div>
      </va-card>

      <va-card class="table-bottom">
        <h3>
          <i class="fa fa-fw fa-table"></i>
          {{ t('network.partners_at_level') }} {{ currentLevel + 1 }}
        </h3>
        <div class="inner">
          <ResourceTable :columns="columns" :endpoint="endpoint" @data:fetched="onGetPartners" />
        </div>
      </va-card>
    </div>
  </va-inner-loading>
</template>

<script setup>
  import { ref, onMounted, computed, watch } from 'vue'
  import VaChart from '../../../components/va-charts/VaChart.vue'
  import moment from 'moment'
  import ResourceTable from '../../../components/tables/ResourceTable.vue'
  import { useI18n } from 'vue-i18n'
  import { useColors } from 'vuestic-ui'
  import axios from 'axios'

  const { colors } = useColors()
  const { t } = useI18n()
  const columns = [
    { key: 'partner.avatar', label: 'avatar', name: 'avatar' },
    { key: 'partner', name: 'partner_and_sponsor', label: 'partner_and_sponsor', sortable: true },
    { key: 'count', name: 'partner_quantity', label: 'partner_quantity', sortable: true },
    { key: 'activation_date' },
  ]

  const partners = ref([])
  const dataFetched = ref(false)
  const levels = 10
  const currentLevel = ref(0)
  const maxLevel = ref(1)

  const getLabels = () => {
    const dateArray = []
    let currentDate = moment().startOf('month')
    const stopDate = moment().endOf('month')

    while (currentDate <= stopDate) {
      dateArray.push(moment(currentDate).format('DD.MM'))
      currentDate = moment(currentDate).add(1, 'days')
    }
    return dateArray
  }
  const labels = getLabels()

  const endpoint = computed(() => {
    return `/api/network/${currentLevel.value + 1}`
  })

  watch(endpoint, () => {
    dataFetched.value = false
  })

  const chartData = computed(() => {
    const registeredDates = partners.value.reduce(
      (acc, cur) => {
        const date = moment(cur.created_at).format('DD.MM')
        acc[labels.indexOf(date)] += 1
        return acc
      },
      Array.from(Array(labels.length), () => 0),
    )
    const activationDates = partners.value.reduce(
      (acc, cur) => {
        const date = moment(cur.activation_date).format('DD.MM')
        acc[labels.indexOf(date)] += 1
        return acc
      },
      Array.from(Array(labels.length), () => 0),
    )
    return {
      labels,
      datasets: [
        {
          label: t('network.registered_label'),
          backgroundColor: colors.success,
          borderColor: colors.success,
          data: registeredDates,
        },
        {
          label: t('network.activated_label'),
          backgroundColor: colors.info,
          borderColor: colors.info,
          data: activationDates,
        },
      ],
    }
  })

  const activatedPartners = computed(() => {
    return partners.value.filter((partner) => !!partner.activation_date)
  })

  const activationPercentage = computed(() => (activatedPartners.value.length / partners.value.length) * 100)

  const getMaxLevel = async () => {
    const { data } = await axios.get('/api/network/level')
    maxLevel.value = data.max_level
  }

  const onGetPartners = async ({ data }) => {
    dataFetched.value = true
    partners.value = data
  }

  onMounted(getMaxLevel)
</script>

<style lang="scss"></style>
