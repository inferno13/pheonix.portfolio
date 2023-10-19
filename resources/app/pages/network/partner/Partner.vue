<template>
  <va-inner-loading :loading="!dataFetched">
    <div class="line partners">
      <div class="cent-nt">
        <h3>{{ t('pages.partners') }}</h3>
      </div>

      <va-card v-if="chartData" class="chart-widget">
        <h3>
          <i class="fa fa-fw fa-line-chart"></i>
          {{ t('network.chart') }} график
        </h3>
        <div class="chart-overflow">
          <va-chart :data="chartData" type="line" />
        </div>
      </va-card>

      <div class="partner-cards">
        <div class="card">
          <h3>{{ partners.length }} чел.</h3>
          <p>{{ t('network.partner_quantity') }}</p>
        </div>
        <div class="card">
          <h3>{{ activatedPartners.length }} чел.</h3>
          <p>{{ t('network.activated_partners') }}</p>
        </div>
        <div class="card">
          <h3>{{ activationPercentage || 0 }}%</h3>
          <p>{{ t('network.activation_percentage') }}</p>
        </div>
      </div>

      <va-card class="table-bottom">
        <h3>
          <i class="fa fa-fw fa-table"></i>
          {{ t('network.partners') }}
        </h3>
        <ResourceTable :columns="columns" :endpoint="endpoint" @data:fetched="onGetPartners" />
      </va-card>
    </div>
  </va-inner-loading>
</template>

<script setup>
  import { ref, computed } from 'vue'
  import VaChart from '../../../components/va-charts/VaChart.vue'
  import moment from 'moment'
  import ResourceTable from '../../../components/tables/ResourceTable.vue'
  import { useI18n } from 'vue-i18n'
  import { useColors } from 'vuestic-ui'

  const { colors } = useColors()
  const { t } = useI18n()
  const columns = [
    { key: 'partner.avatar', label: 'avatar', name: 'avatar' },
    { key: 'partner.username', name: 'partner_name', label: 'partner_name', sortable: true },
    { key: 'count', name: 'partner_quantity', label: 'partner_quantity', sortable: true },
  ]

  const partners = ref([])

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
  const dataFetched = ref(false)

  const endpoint = '/api/network'

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

  const onGetPartners = async ({ data }) => {
    partners.value = data
    dataFetched.value = true
  }
</script>

<style lang="scss">
  .chart-widget {
    .va-card__content {
      height: 450px;
    }
  }
</style>
