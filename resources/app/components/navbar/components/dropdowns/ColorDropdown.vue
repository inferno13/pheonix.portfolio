<template>
  <va-switch
    v-model="isDarkTheme"
    color="#ffd300"
    off-color="rgba(255, 255, 255, 0.15)"
    style="--va-switch-checker-background-color: #FFF"
  >
    <template #innerLabel>
      <div class="va-text-center">
        <va-icon size="25px" :name="isDarkTheme ? 'light_mode' : 'dark_mode'" />
      </div>
    </template>
  </va-switch>
</template>

<script setup lang="ts">
  import { useColors } from 'vuestic-ui'
  import { ref, watchEffect } from 'vue'

  const { applyPreset } = useColors()

  const isDarkTheme = ref(false)

  watchEffect(() => {
    applyPreset(isDarkTheme.value ? 'dark' : 'light')
  })
</script>

<style lang="scss" scoped>
  .color-dropdown {
    cursor: pointer;

    &__icon {
      position: relative;
      display: flex;
      align-items: center;
    }

    .va-dropdown__anchor {
      display: inline-block;
    }

    &__toggle {
      width: 100%;
      display: flex;
      justify-content: stretch;
    }
  }

  .button-restore {
    display: flex;
    margin: 0.375rem auto;
  }

  table {
    margin: 1rem 0;
  }
</style>
