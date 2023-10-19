<template>
  <div class="activity-log">

      <div class="cent-nt">
          <h3>История активностей</h3>
      </div>

      <va-card>
          <div class="inner">
              <ResourceTable endpoint="/api/activity" :columns="columns" />
          </div>
      </va-card>
  </div>
</template>

<script setup>
  import ResourceTable from '../../components/tables/ResourceTable.vue'
  const columns = [
    { key: 'action', label: 'activity_action', name: 'activity_action' },
    { key: 'ip_address' },
    { key: 'user_agent' },
    { key: 'created_at' },
  ]
</script>

<style>
    .activity-log{
        width: 80%;
        margin: auto;
    }
    @media (max-width:1200px){
        .activity-log{
            width: 95%;
            margin: auto;
        }
    }
</style>
