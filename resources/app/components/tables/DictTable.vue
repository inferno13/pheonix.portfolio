<template>
  <div class="va-table-responsive">
    <table class="va-table va-table--striped">
      <tbody>
        <tr v-for="(item, index) in items" :key="index">
          <td>{{ t(`list_items.${item.name.replace('.', '_')}`) }}</td>

          <td v-if="item.name === 'product_key'">
              {{ item.value }}
          </td>
          <td
            v-else-if="
              [
                'currency',
                'crypto',
                'index',
                'period',
                'tutorial',
                'tech_support',
                'marketing',
                'bonus',
                'pull',
              ].includes(item.name)
            "
          >
            <va-badge :text="t(getBooleanText(item.value))" :color="getBooleanColor(item.value)" />
          </td>
          <td v-else-if="item.name === 'price'">{{ item.value }} PX</td>
          <td v-else-if="item.name === 'license'">{{ item.value }} {{ t('utils.items') }}</td>
          <td v-else>{{ item.value }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
  import { defineProps, computed } from 'vue'
  import { useI18n } from 'vue-i18n'
  import { getBooleanText, getBooleanColor } from '../../utils'

  const { t } = useI18n()
  const props = defineProps({
    data: {
      type: Object,
      required: true,
      default: () => {
        return {}
      },
    },
    excludeColumns: {
      type: Array,
      required: false,
      default: () => {
        return []
      },
    },
  })

  const items = computed({
    get() {
      return Object.entries(props.data)
        .map(([name, value]) => {
          return { name, value }
        })
        .filter((item) => !props.excludeColumns.includes(item.name))
    },
  })
  console.log(items)
</script>
