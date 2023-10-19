<template>
  <div class="TabbedView">
    <div class="TabbedView__Tabs">
      <va-card>
        <div class="TabbedView__Controls">
          <va-tabs v-model="selectedTab">
            <va-tab v-for="tab in props.tabs.map((tab) => t(`tabbed_view.${tab}`))" :key="tab">
              {{ tab }}
            </va-tab>
          </va-tabs>
          <div><slot name="controls"></slot></div>
        </div>
      </va-card>
    </div>
    <div class="TabbedView__Container">
      <template v-if="selectedItems.length > 0">
        <template v-for="(item, index) in selectedItems" :key="index">
          <slot name="item" :item="item"> </slot>
        </template>
      </template>
      <template v-else>
        <div>{{ t('tables.is_empty.no_data') }}</div>
      </template>
    </div>
  </div>
</template>

<script setup>
  import { defineProps, ref, computed } from 'vue'
  import { useI18n } from 'vue-i18n'

  const { t } = useI18n()
  const selectedTab = ref(0)
  const props = defineProps({
    items: {
      default: () => [],
      required: true,
      type: Array,
    },
    tabs: {
      default: () => [],
      required: true,
      type: Array,
    },
    filterBy: {
      default: (item) => {
        return item.status
      },
      required: false,
      type: Function,
    },
  })

  const selectedItems = computed(() => {
    return props.items.filter((item) => props.filterBy(item) === props.tabs[selectedTab.value])
  })
</script>

<style lang="scss">
  .TabbedView {
    &__Container {
      margin-top: 1.5em;
    }

    &__Controls {
      display: flex;
      justify-content: space-between;
        align-items: center;
    }

    &__Tabs {
      .va-card {
        background-color: var(--va-background-primary) !important;
      }
      .va-tabs__wrapper {
        flex: 0;
      }
      .va-tab {
        &__content {
            padding: .75em;
            border-radius: 5px;
          color: var(--bs-purple);
        }
        &[aria-selected='true'] {
          .va-tab__content {
            color: var(--va-text-primary);
            background-color: var(--gray-op-10);
          }
        }
      }
    }
  }
</style>
