import { defineStore } from 'pinia'
import { useLocalStorage } from '@vueuse/core'
import axios from 'axios'

export const useGlobalStore = defineStore('global', {
  state: () => {
    return {
      isSidebarMinimized: false,
      balance: '0',
      user: (window as any).user as any,
      notifications: [] as any,
      fakeUser: useLocalStorage('fakeUser', false),
    }
  },

  actions: {
    toggleSidebar() {
      this.isSidebarMinimized = !this.isSidebarMinimized
    },
    async getUser(endpoint = '/api/me') {
      const { data } = await axios.get(endpoint)
      this.user = data.data
      this.getNotifications()
    },
    setFakeUser(value: boolean) {
      this.fakeUser = value
    },
    async getNotifications() {
      const { data } = await axios.get('/api/notification')
      this.notifications = data.data
    },

    addNotification(notification: any) {
      this.notifications.unshift(notification)
    },

    changeUser(user: any) {
      this.user = {
        ...this.user,
        ...user,
      }
    },
  },
})
