<template>
  <div v-if="fakeUser" class="SwitchUserMenu">
    <span class="SwitchUserMenu__Attention">{{ t('switch_user.attention') }}!</span>
    {{ t('switch_user.message') }}
    <span class="SwitchUserMenu__Username">{{ user.username }}</span
    >.
    <a class="SwitchUserMenu__Logout" href="javascript:void(0);" @click.prevent="logout">{{
      t('switch_user.logout')
    }}</a>
  </div>
</template>

<script setup>
  import axios from 'axios'
  import { useI18n } from 'vue-i18n'
  import { useGlobalStore } from '../../stores/global-store'
  import { storeToRefs } from 'pinia'
  import router from '../../router'

  const GlobalStore = useGlobalStore()
  const { setFakeUser, getUser } = GlobalStore
  const { user, fakeUser } = storeToRefs(GlobalStore)
  const { t } = useI18n()

  const logout = async () => {
    await axios.get(`/api/switch-user/logout`)
    setFakeUser(false)
    router.go('/dashboard')
  }
</script>

<style lang="scss">
  .SwitchUserMenu {
    background-color: var(--va-warning);
    padding: 1em;
    text-align: center;
    &__Attention,
    &__Username {
      font-weight: bold;
    }
  }
</style>
