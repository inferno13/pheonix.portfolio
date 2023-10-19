<template>
  <va-form tag="form" @submit.prevent="submit">
    <div v-for="group in schema" :key="group.name">
      <va-divider v-if="group.showDivider">
        <span class="px-2">{{ t(`dividers.${group.name}`) }}</span>
      </va-divider>
      <div class="row">
        <div v-if="group.description" class="flex xs6">
          {{ t(`descriptions.${group.description}`) }}
        </div>
        <div class="flex" :class="`${group.description ? 'xs6' : 'xs12'}`">
          <template v-for="(value, name) in group.fields" :key="name">
            <template v-if="value.type === 'select'">
              <div class="input-group">
                <label>{{ t(`forms.${name}`) }}</label>
                <va-select v-model="formLocal[name]" class="mt-2" :options="value.options" />
              </div>
            </template>
            <template v-else-if="value.type === 'switch'">
              <va-switch v-model="formLocal[name]" :label="t(`forms.${name}`)" class="mr-4" />
            </template>
            <template v-else>
                <div class="input-group">
                    <label>{{ t(`forms.${name}`) }}</label>
                    <va-input
                        v-model="formLocal[name]"
                        :placeholder="t(`forms.${value.placeholder}`)"
                        class="mt-1"
                        :error="formLocal.errors.has(name)"
                        :options="value.options"
                    />
                </div>
            </template>
          </template>
        </div>
      </div>
    </div>
    <button type="submit" class="light-purple-button dark">
        {{ t('forms.submit') }}
    </button>
  </va-form>
</template>

<script setup>
  import { defineProps, defineEmits, computed } from 'vue'
  import { useI18n } from 'vue-i18n'
  const { t } = useI18n()
  const emit = defineEmits(['form:submit'])

  const props = defineProps({
    schema: {
      type: Array,
      default: () => [],
    },
    form: {
      type: Object,
      default: () => {
        return {}
      },
    },
  })

  const formLocal = computed({
    get() {
      return props.form
    },
  })

  const submit = () => {
    emit('form:submit', props.form)
  }
</script>
