<template>
  <Line :chart-options="chartOptions" :chart-data="props.chartData" />
</template>

<script setup lang="ts">
  import { Line } from 'vue-chartjs'
  import type { TChartOptions } from 'vue-chartjs/dist/types'
  import {
    Chart as ChartJS,
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Legend,
  } from 'chart.js'
  import { TLineChartData } from '../../../data/types'

  ChartJS.register(CategoryScale, LinearScale, PointElement, LineElement, Title, Tooltip, Legend)

  const props = defineProps<{
    chartData: TLineChartData
    chartOptions?: TChartOptions<'line'>
  }>()
</script>
