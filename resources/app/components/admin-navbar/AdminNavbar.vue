<template>
  <va-navbar class="adminNavbar">
    <template #left> </template>
    <template #center>
      <va-navbar-item v-for="(item, index) in menuItems" :key="index">
        <template v-if="(item.meta.isSuperAdmin && user.roles.includes('superadmin')) || !item.meta.isSuperAdmin">
          <va-dropdown v-if="item.children" class="operations-dropdown">
            <template #anchor>
              <va-icon tag="span" :name="item.meta.icon" />
              <span>{{ t(`menu.${item.name}`) }}</span>
            </template>
            <va-dropdown-content>
              <va-list-item v-for="(child, childIdx) in item.children" :key="childIdx" class="pa-2">
                <router-link :to="child.path">
                  {{ t(`menu.${child.name}`) }}
                  <span v-if="child.name === 'dwithdraw'" class="adminNavbar__counter">
                    {{ user.withdraw_request_count }}
                  </span>
                </router-link>
              </va-list-item>
            </va-dropdown-content>
          </va-dropdown>
          <template v-else>
            <router-link class="navbar-link" :to="item.path">
              <va-icon tag="span" :name="item.meta.icon" />
              <span>{{ t(`menu.${item.name}`) }}</span>
            </router-link>
          </template>
        </template>
      </va-navbar-item>
    </template>
    <template #right> </template>
  </va-navbar>
</template>

<script setup>
  import { useI18n } from 'vue-i18n'
  import menuItems from './menuItems'
  import { storeToRefs } from 'pinia'
  import { useGlobalStore } from '../../stores/global-store'
  const GlobalStore = useGlobalStore()
  const { user } = storeToRefs(GlobalStore)
  const { t } = useI18n()
</script>

<style lang="scss">
  .operations-dropdown {
    cursor: pointer;
  }

  .adminNavbar {
    &__counter {
      display: inline-block;
      background-color: var(--bs-purple);
      border-radius: 50%;
      padding: 0.2em;
      font-weight: bold;
      margin-left: 0.3em;
    }
  }

  .navbar-link {
    display: flex;
  }
</style>
