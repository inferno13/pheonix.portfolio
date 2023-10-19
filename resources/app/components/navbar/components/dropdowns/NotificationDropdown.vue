<template>
  <div class="notification mr-2">
    <router-link class="notification-link" :to="'/notifications'">
      <va-icon :name="unreadNotifications.length > 0 ? 'notifications_active' : 'notifications'" />
      <span v-if="unreadNotifications.length > 0" class="unread-notifications">{{ unreadNotifications.length }}</span>
    </router-link>
  </div>
</template>

<script setup>
  import { useToast, useColors } from 'vuestic-ui'
  import { useGlobalStore } from '../../../../stores/global-store'
  import { computed } from 'vue'
  import { useI18n } from 'vue-i18n'
  import { storeToRefs } from 'pinia'

  const GlobalStore = useGlobalStore()
  const { addNotification } = GlobalStore
  const { user, notifications } = storeToRefs(GlobalStore)
  const { t } = useI18n()
  const { init: initToast } = useToast()
  const { getColors } = useColors()
  const colors = getColors()

  window.Echo.private(`notification.user.${user.value.id}`).listen('NotificationSent', ({ notification }) => {
    const message = `${t(`notifications.${notification.name}`)} (${t('utils.status')}: ${t(
      `status.${notification.details.status}`,
    )})`
    initToast({ message, color: colors.info })
    addNotification(notification)
  })

  const unreadNotifications = computed(() => {
    return notifications.value.filter((notification) => notification.unread)
  })
</script>

<style lang="scss" scoped>
  .notification-link {
    display: inherit;
    color: inherit;
  }
  .row {
    flex-wrap: nowrap !important;
  }
  .md6 {
    box-sizing: border-box;
  }
</style>
