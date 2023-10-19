<template>
  <div class="app-navbar-actions">
    <notification-dropdown class="app-navbar-actions__item" />
    <profile-dropdown class="app-navbar-actions__item app-navbar-actions__item--profile">
      <span>{{ userName }}</span>
    </profile-dropdown>
    <color-dropdown class="app-navbar-actions__item" />
  </div>
</template>

<script setup lang="ts">
  import ProfileDropdown from './dropdowns/ProfileDropdown.vue'
  import NotificationDropdown from './dropdowns/NotificationDropdown.vue'
  import ColorDropdown from './dropdowns/ColorDropdown.vue'

  withDefaults(
    defineProps<{
      userName?: string
      isTopBar?: boolean
    }>(),
    {
      userName: '',
      isTopBar: false,
    },
  )

  defineEmits<{
    (e: 'update:isTopBar', isTopBar: boolean): void
  }>()
</script>

<style lang="scss">
  .app-navbar-actions {
    display: flex;
    align-items: center;

    .va-dropdown__anchor {
      color: var(--va-primary);
      fill: var(--va-primary);
    }

    &__item {
      padding: 0;
      margin-left: 1.25rem;
      margin-right: 1.25rem;

      svg {
        height: 24px;
      }

      &:last-of-type {
        margin-right: 0;
      }

      &--profile {
        display: flex;
        justify-content: center;
        margin: auto 0 auto 1.25rem;
      }

      .va-dropdown-content {
        background-color: var(--va-white);
      }
    }
  }
</style>
