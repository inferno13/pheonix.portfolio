<template>
  <va-navbar class="app-layout-navbar navbar-top">
    <template #left>
      <router-link to="/">
        <img :src="'/media/logos/logo-short-white.png'" alt="logo" class="logo-nav" />
      </router-link>

      <button class="show-menu" @click="isSidebarMinimized = !isSidebarMinimized">
        <i class="fa fa-fw fa-bars" />
      </button>
    </template>
    <template #right>
      <button class="invite-but" @click.prevent="showModal = !showModal">{{ t('navbar.invite') }}</button>
      <div class="balance">{{ Number(user.balance).toFixed(3) }} PX</div>
      <app-navbar-actions class="app-navbar__actions md5 lg4" :user-name="user.username" />
    </template>
  </va-navbar>
  <va-modal v-model="showModal" size="large" hide-default-actions :title="t('navbar.invite')">
    <template #header>
      <va-card-content>
        <Clipboard :message="inviteLink" />
      </va-card-content>
    </template>
  </va-modal>
</template>

<script setup>
  import { ref } from 'vue'
  import { storeToRefs } from 'pinia'
  import { useGlobalStore } from '../../stores/global-store'
  import { useI18n } from 'vue-i18n'
  import Clipboard from '../../components/clipboard/Clipboard.vue'
  import AppNavbarActions from './components/AppNavbarActions.vue'

  const GlobalStore = useGlobalStore()
  const { t } = useI18n()
  const showModal = ref(false)
  const { isSidebarMinimized, user } = storeToRefs(GlobalStore)
  const inviteLink = ref(`${window.location.origin}/register?invite_code=${user.value.invite_code}`)
</script>

<style lang="scss" scoped>
  .va-navbar {
    box-shadow: var(--va-box-shadow);
    z-index: 2;
  }

  .left {
    display: flex;
    align-items: center;

    & > * {
      margin-right: 1.5rem;
    }

    & > *:last-child {
      margin-right: 0;
    }
  }

  .x-flip {
    transform: scaleX(-100%);
  }

  .app-navbar-center {
    display: flex;
    align-items: center;

    @media screen and (max-width: 1200px) {
      &__github-button {
        display: none;
      }
    }

    @media screen and (max-width: 950px) {
      &__text {
        display: none;
      }
    }
  }
</style>
