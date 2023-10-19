<template>
  <div class="dashboard">
    <nav class="bg-nt">
      <h3>Привет, {{ user.username }}!</h3>
    </nav>

    <div class="dashboard-inner">
      <dashboard-info-block />
    </div>
  </div>
</template>

<script setup>
  import DashboardInfoBlock from './DashboardInfoBlock.vue'
  import { useGlobalStore } from '../../stores/global-store'

  const { user } = useGlobalStore()
</script>

<style lang="scss">
  .row-equal .flex {
    .va-card {
      height: 100%;
    }
  }

  .dashboard {
    .va-card {
      margin-bottom: 0 !important;
      &__title {
        display: flex;
        justify-content: space-between;
      }
    }
  }
</style>
