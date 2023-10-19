<template>
  <div class="cent-nt not-list">
    <h3>{{ t('pages.notification') }}</h3>
  </div>
  <div class="notification-list">
    <TabbedView :filter-by="filterBy" :tabs="tabs" :items="notifications">
      <template #item="{ item }">
        <NotificationItem :item="item" />
      </template>
      <template #controls>
        <va-button class="read-all-btn" icon="local_library" preset="secondary" @click="readAll">{{
          t('notifications.read_all')
        }}</va-button>
      </template>
    </TabbedView>
  </div>
</template>

<script setup>
  import { useGlobalStore } from '../../stores/global-store'
  import { useI18n } from 'vue-i18n'
  import { storeToRefs } from 'pinia'
  import TabbedView from '../../components/tabbed-view/TabbedView.vue'
  import NotificationItem from './NotificationItem.vue'
  import axios from 'axios'

  const GlobalStore = useGlobalStore()
  const { notifications } = storeToRefs(GlobalStore)
  const { t } = useI18n()
  const tabs = ['unread', 'read']

  const filterBy = (item) => {
    return item.unread ? 'unread' : 'read'
  }

  const readAll = () => {
    notifications.value.forEach((notification) => {
      notification.unread = false
      axios.put(`/api/notification/${notification.id}`, { unread: false })
    })
  }
</script>

<style lang="scss">
  .notification-list {
    width: 90%;
    margin: 0 auto 2em;
  }

  .read-all-btn {
    color: inherit !important;
    font-weight: normal;
    .va-icon {
      color: inherit !important;
      font-weight: normal;
    }
  }

  .va-chip.va-chip--small {
    background: var(--bs-purple) !important;
    border-radius: 5px;
  }
  .notification-list .va-card__content {
    width: 100%;
    overflow-x: scroll;
  }
  .notification-list .va-card__content table {
    min-width: 500px;
  }
</style>
