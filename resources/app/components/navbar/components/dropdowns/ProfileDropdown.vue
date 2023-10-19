<template>
  <div class="profile-dropdown-wrapper">
    <va-dropdown v-model="isShown" class="profile-dropdown" stick-to-edges placement="bottom" :offset="[13, 0]">
      <template #anchor>
        <span class="profile-dropdown__anchor user">
          <i class="fa fa-fw fa-user" />
          <va-icon :name="isShown ? 'angle_up' : 'angle_down'" />
        </span>
      </template>
      <va-dropdown-content class="profile-dropdown__content mr-2">
        <div class="avatar"><img :src="user.avatar" /></div>
        <va-list-item class="pa-2">
          <router-link :to="`/profile/${user.id}`" class="profile-dropdown__item">
            {{ t('user.profile') }}
          </router-link>
        </va-list-item>
        <va-list-item class="pa-2">
          <router-link :to="`/activity`" class="profile-dropdown__item">
            {{ t('user.activity') }}
          </router-link>
        </va-list-item>
        <va-list-item class="pa-2">
          <span class="profile-dropdown__item" @click.prevent="logout">
            {{ t('user.logout') }}
          </span>
        </va-list-item>
      </va-dropdown-content>
    </va-dropdown>
  </div>
</template>

<script setup lang="ts">
  import { storeToRefs } from 'pinia'
  import { ref } from 'vue'
  import { useI18n } from 'vue-i18n'
  import { useGlobalStore } from '../../../../stores/global-store'

  const { t } = useI18n()
  const GlobalStore = useGlobalStore()
  const { user } = storeToRefs(GlobalStore)

  withDefaults(
    defineProps<{
      options?: { name: string; redirectTo: string }[]
    }>(),
    {
      options: () => [
        {
          name: 'profile',
          redirectTo: '',
        },
        {
          name: 'logout',
          redirectTo: 'logout',
        },
      ],
    },
  )

  const logout = () => {
    const form = document.querySelector('#logout-form') as HTMLFormElement
    form.submit()
  }

  const isShown = ref(false)
</script>

<style lang="scss" scoped>
  .profile-dropdown {
    cursor: pointer;
    padding: 0;

    &__anchor {
      display: inline-block;
    }

    &__content {
      padding: 0;
    }

    &__item {
      display: block;
      color: var(--va-gray);

      &:hover,
      &:active {
        color: var(--va-primary);
      }
    }

    .avatar {
      display: flex;
      background: var(--bs-purple);
      padding: 1em;
      justify-content: center;

      img {
        display: block;
        width: 50px;
        height: 50px;
        border-radius: 50%;
      }
    }
  }
</style>
