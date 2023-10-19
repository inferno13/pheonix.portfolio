<template>
  <va-inner-loading :loading="!user">
    <div v-if="user" class="app-layout">
      <navbar />
      <div class="app-layout__content">
        <div class="app-layout__sidebar-wrapper" :class="{ minimized: isSidebarMinimized }">
          <div v-if="isFullScreenSidebar" class="header-close">
            <img :src="'/media/logos/logo-short-white.png'" alt="" />
            <va-button
              class="px-4 py-4"
              icon="md_close"
              preset="plain"
              color="dark"
              @click="onCloseSidebarButtonClick"
            />
          </div>
          <sidebar
            :width="sidebarWidth"
            :minimized="isSidebarMinimized"
            :minimized-width="sidebarMinimizedWidth"
            :animated="!isMobile"
          />
        </div>
        <div class="app-layout__page">
          <admin-navbar v-if="user.roles.includes('admin')" />
          <switch-user-menu />
          <div class="layout fluid">
            <router-view />
          </div>
        </div>
      </div>
    </div>
  </va-inner-loading>
</template>

<script setup>
  import { computed, onBeforeUnmount, onMounted, ref } from 'vue'
  import { storeToRefs } from 'pinia'
  import { onBeforeRouteUpdate } from 'vue-router'

  import { useGlobalStore } from '../stores/global-store'

  import AdminNavbar from '../components/admin-navbar/AdminNavbar.vue'
  import SwitchUserMenu from '../components/switch-user-menu/SwitchUserMenu.vue'
  import PageHeader from '../components/page-header/PageHeader.vue'
  import Navbar from '../components/navbar/Navbar.vue'
  import Sidebar from '../components/sidebar/Sidebar.vue'

  const GlobalStore = useGlobalStore()

  const mobileBreakPointPX = 640
  const tabletBreakPointPX = 768

  const sidebarWidth = ref('16rem')
  const sidebarMinimizedWidth = ref(undefined)

  const isMobile = ref(false)
  const isTablet = ref(false)
  const { isSidebarMinimized, user } = storeToRefs(GlobalStore)
  const checkIsTablet = () => window.innerWidth <= tabletBreakPointPX
  const checkIsMobile = () => window.innerWidth <= mobileBreakPointPX

  const onResize = () => {
    isSidebarMinimized.value = checkIsTablet()

    isMobile.value = checkIsMobile()
    isTablet.value = checkIsTablet()
    sidebarMinimizedWidth.value = isMobile.value ? '0' : '4.5rem'
    sidebarWidth.value = isTablet.value ? '100%' : '16rem'
  }

  onMounted(() => {
    window.addEventListener('resize', onResize)
  })

  onBeforeUnmount(() => {
    window.removeEventListener('resize', onResize)
  })

  onBeforeRouteUpdate(() => {
    if (checkIsTablet()) {
      // Collapse sidebar after route change for Mobile
      isSidebarMinimized.value = true
    }
  })

  onResize()

  const isFullScreenSidebar = computed(() => isTablet.value && !isSidebarMinimized.value)

  const onCloseSidebarButtonClick = () => {
    isSidebarMinimized.value = true
  }
</script>

<style lang="scss">
  $mobileBreakPointPX: 640px;
  $tabletBreakPointPX: 768px;

  .app-layout {
    height: 100vh;
    display: flex;
    flex-direction: column;
    &__navbar {
      min-height: 4rem;
    }

    &__content {
      display: flex;
      height: calc(100vh - 4rem);
      flex: 1;

      .app-layout__sidebar-wrapper {
        position: relative;
        height: 100%;
        background: var(--va-white);

        @media screen and (max-width: $tabletBreakPointPX) {
          &:not(.minimized) {
            position: absolute;
            top: 0;
            z-index: 99;
          }

          .va-sidebar:not(.va-sidebar--minimized) {
            // Z-index fix for preventing overflow for close button
            //z-index: -1;
            .va-sidebar__menu {
              padding: 0;
            }
          }
        }
      }
    }
    &__page {
      flex-grow: 2;
      overflow-y: auto;
      .layout {
        //padding: 1.5em;
      }
    }
  }
</style>
