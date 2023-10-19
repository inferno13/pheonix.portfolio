<template>
  <div class="UserNameplate">
    <div>
      <img class="UserNameplate__Avatar" :src="user.avatar" alt="avatar" />
    </div>
    <div class="UserNameplate__Info">
      <router-link :to="`/profile/${user.id}`" class="UserNameplate__Username">{{ user.username }}</router-link>
      <div class="UserNameplate__FullName">
        {{ t('utils.full_name') }}: {{ user.full_name ? user.full_name : t('utils.not_defined') }}
      </div>
    </div>
  </div>
</template>

<script setup>
  import { defineProps } from 'vue'
  import { useI18n } from 'vue-i18n'

  const { t } = useI18n()

  defineProps({
    user: {
      required: true,
      type: Object,
    },
  })
</script>

<style lang="scss">
  .UserNameplate {
    display: flex;
    justify-content: flex-start;
    align-items: center;

    &__Info {
      padding-left: 0.5em;
      text-align: left;
    }

    &__Avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
    }

    &__Username {
      color: var(--bs-purple);
      font-weight: bold;
      display: block;
      padding-bottom: 0.5em;
    }
  }
</style>
