<template>
  <div class="resource-table">
    <va-inner-loading :loading="!pagination">
      <div v-if="pagination" class="resource-table">
        <div class="mt-3 mb-4">
          <button v-if="crudable" class="light-purple-button dark" @click.prevent="createModal">
            {{ t('utils.create') }}
          </button>
        </div>
        <va-data-table
          :no-data-html="noDataHtml"
          :loading="!pagination"
          :hoverable="true"
          :items="pagination.data"
          :columns="computedColumns"
          :per-page="pagination.meta.per_page"
          :current-page="pagination.meta.currentPage"
          @selection-change="selectedItems = $event.currentSelectedItems"
        >
          <template #header(transaction_type)="{ label }">{{ getHeading(label) }}</template>
          <template #header(status)="{ key }">{{ getHeading(key) }}</template>
          <template #header(amount)="{ label }">{{ getHeading(label) }}</template>
          <template #header(created_at)="{ key }">{{ getHeading(key) }}</template>
          <template #header(updated_at)="{ key }">{{ getHeading(key) }}</template>
          <template #header(has_bonus)="{ key }">{{ getHeading(key) }}</template>
          <template #header(email)="{ key }">{{ getHeading(key) }}</template>
          <template #header(balance)="{ key }">{{ getHeading(key) }}</template>
          <template #header(address)="{ key }">{{ getHeading(key) }}</template>
          <template #header(ip_address)="{ key }">{{ getHeading(key) }}</template>
          <template #header(roles)="{ key }">{{ getHeading(key) }}</template>
          <template #header(user_agent)="{ key }">{{ getHeading(key) }}</template>
          <template #header(currency)="{ key }">{{ getHeading(key) }}</template>
          <template #header(license)="{ key }">{{ getHeading(key) }}</template>
          <template #header(crypto)="{ key }">{{ getHeading(key) }}</template>
          <template #header(period)="{ key }">{{ getHeading(key) }}</template>
          <template #header(tutorial)="{ key }">{{ getHeading(key) }}</template>
          <template #header(name)="{ key }">{{ getHeading(key) }}</template>
          <template #header(patronymic)="{ key }">{{ getHeading(key) }}</template>
          <template #header(surname)="{ key }">{{ getHeading(key) }}</template>
          <template #header(product_name)="{ label }">{{ getHeading(label) }}</template>
          <template #header(product_key)="{ key }">{{ getHeading(key) }}</template>
          <template #header(activation_date)="{ key }">{{ getHeading(key) }}</template>
          <template #header(expires_at)="{ key }">{{ getHeading(key) }}</template>
          <template #header(price)="{ key }">{{ getHeading(key) }}</template>
          <template #header(count)="{ key }">{{ getHeading(key) }}</template>
          <template #header(partner_name)="{ label }">{{ getHeading(label) }}</template>
          <template #header(partner_username)="{ label }">{{ getHeading(label) }}</template>
          <template #header(avatar)><va-icon class="avatar-heading" tag="div" name="person" /></template>
          <template #header(count_partners)="{ label }">{{ getHeading(label) }}</template>
          <template #header(partner_quantity)="{ label }">{{ getHeading(label) }}</template>
          <template #header(level)="{ key }">{{ getHeading(key) }}</template>
          <template #header(is_activated)="{ key }">{{ getHeading(key) }}</template>
          <template #header(actions)></template>
          <template #header(type)="{ key }">{{ getHeading(key) }}</template>
          <template #header(user)="{ key }">{{ getHeading(key) }}</template>
          <template #header(username)="{ key }">{{ getHeading(key) }}</template>
          <template #header(description)="{ key }">{{ getHeading(key) }}</template>
          <template #header(title)="{ key }">{{ getHeading(key) }}</template>
          <template #header(bonus)="{ key }">{{ getHeading(key) }}</template>
          <template #header(pull)="{ key }">{{ getHeading(key) }}</template>
          <template #header(pull_status)="{ key }">{{ getHeading(key) }}</template>
          <template #header(tech_support)="{ key }">{{ getHeading(key) }}</template>
          <template #header(sender)="{ label }">{{ getHeading(label) }}</template>
          <template #header(crypto_currency)="{ label }">{{ getHeading(label) }}</template>
          <template #header(crypto_amount)="{ label }">{{ getHeading(label) }}</template>
          <template #header(payment_method)="{ label }">{{ getHeading(label) }}</template>
          <template #header(recipient)="{ label }">{{ getHeading(label) }}</template>
          <template #header(has_currency)="{ label }">{{ getHeading(label) }}</template>
          <template #header(activity_action)="{ label }">{{ getHeading(label) }}</template>
          <template #header(transfer_amount)="{ label }">{{ getHeading(label) }}</template>
          <template #header(accrual)="{ label }">{{ getHeading(label) }}</template>
          <template #header(partner_and_sponsor)="{ label }">{{ getHeading(label) }}</template>
          <template #header(history_amount)="{ label }">{{ getHeading(label) }}</template>
          <template #header(user_nameplate)="{ label }">{{ getHeading(label) }}</template>
          <template #header(user_nameplate_attr)="{ label }">{{ getHeading(label) }}</template>
          <template #header(sign_up_date)="{ label }">{{ getHeading(label) }}</template>

          <template #cell(transaction_type)="{ value }">
            <va-chip size="small">{{ getCellValue(value) }}</va-chip>
          </template>
          <template #cell(payment_method)="{ value }"> {{ t(`payment_methods.${value}`) }} </template>
          <template #cell(avatar)="{ value }">
            <img class="avatar" :src="value" />
          </template>
          <template #cell(sender)="{ value }">
            {{ value === user.username ? t('utils.me') : value }}
          </template>
          <template #cell(recipient)="{ value }">
            {{ value === user.username ? t('utils.me') : value }}
          </template>
          <template #cell(accrual)="{ value }"
            ><va-chip size="small">{{ getCellValue(value) }}</va-chip>
          </template>
          <template #cell(has_currency)="{ value }">
            <va-badge :text="t(getBooleanText(value))" :color="getBooleanColor(value)" />
          </template>
          <template #cell(has_bonus)="{ rowKey }">
            <va-badge :text="t(getBooleanText(rowKey.has_bonus))" :color="getBooleanColor(rowKey.has_bonus)" />
          </template>
          <template #cell(activity_action)="{ value }"> {{ t(`activity.actions.${value}`) }} </template>
          <template #cell(crypto)="{ value }">
            <va-badge :text="t(getBooleanText(value))" :color="getBooleanColor(value)" />
          </template>
          <template #cell(tutorial)="{ value }">
            <va-badge :text="t(getBooleanText(value))" :color="getBooleanColor(value)" />
          </template>
          <template #cell(tech_support)="{ value }">
            <va-badge :text="t(getBooleanText(value))" :color="getBooleanColor(value)" />
          </template>
          <template #cell(bonus)="{ value }">
            <va-badge :text="t(getBooleanText(value))" :color="getBooleanColor(value)" />
          </template>
          <template #cell(pull)="{ value }">
            <va-badge :text="t(getBooleanText(value))" :color="getBooleanColor(value)" />
          </template>
          <template #cell(history_amount)="{ value }">
            <span
              :style="{ fontWeight: 'bold', color: value.startsWith('-') ? 'var(--va-danger)' : 'var(--va-success)' }"
              >{{ getHistoryAmountValue(value) }} PX</span
            >
          </template>
          <template #cell(user_nameplate)="{ rowKey }">
            <UserNameplate :user="rowKey" />
          </template>
          <template #cell(user_nameplate_attr)="{ source }">
            <UserNameplate :user="source" />
          </template>
          <template #cell(name)="{ value }"> {{ value || t('utils.no_value') }} </template>
          <template #cell(balance)="{ value }"> {{ Number(value).toFixed(3) }} PX</template>
          <template #cell(crypto_currency)="{ source }">
            <div class="flex justify-center"><Nameplate :name="source.name" :image="source.logo" /></div>
          </template>
          <template #cell(crypto_amount)="{ rowKey }">
            {{ isMinusCryptoAmount(rowKey) ? '-' : '' }}{{ rowKey.amount }}
            {{
              rowKey.deposit_method && rowKey.transaction_type !== 'withdraw_transactions'
                ? rowKey.deposit_method.ticker
                : 'PX'
            }}</template
          >
          <template #cell(surname)="{ value }"> {{ value || t('utils.no_value') }} </template>
          <template #cell(patronymic)="{ value }"> {{ value || t('utils.no_value') }} </template>

          <template #cell(price)="{ value }"> {{ value }} PX </template>
          <template #cell(license)="{ value }"> {{ value }} {{ t('utils.items') }} </template>
          <template #cell(type)="{ value }"> {{ t(`tables.cells.${value}`) }} </template>
          <template #cell(period)="{ value }"> {{ value }} {{ t('utils.months') }} </template>
          <template #cell(amount)="{ value }"> {{ value }} PX </template>
          <template #cell(status)="{ value }">
            <va-badge :text="t(`status.${value}`)" :color="getStatusColor(value)" />
          </template>
          <template #cell(transfer_amount)="{ rowKey }">
            {{ rowKey.recipient.username === user.username ? '+' : '-' }}{{ rowKey.amount }} PX
          </template>
          <template #cell(updated_at)="{ value }">
            <Date :date="value" />
          </template>
          <template #cell(created_at)="{ value }">
            <Date :date="value" />
          </template>
          <template #cell(sign_up_date)="{ value }">
            <Date :date="value" format="DD.MM.YYYY" />
          </template>
          <template #cell(activation_date)="{ value }">
            <Date :date="value" />
          </template>
          <template #cell(partner_and_sponsor)="{ rowKey }">
            <div>
              <div>{{ rowKey.partner.username }}</div>
              <div style="font-size: 0.8em">{{ t('network.sponsor') }}: {{ rowKey.partner.sponsor_username }}</div>
            </div>
          </template>
          <template #cell(user)="{ source }">
            <router-link :to="`/profile/${source.id}`">{{ source.username }}</router-link>
          </template>
          <template #cell(partner)="{ source }">
            {{ source.username }}
          </template>
          <template #cell(ticket_id)="{ value }">
            <router-link :to="`/chat/${value}`">{{ t('utils.view_ticket') }} #{{ value }}</router-link>
          </template>
          <template #bodyAppend>
            <div class="table-pagination">
              <va-pagination
                v-model="pagination.meta.current_page"
                class="my-2"
                :pages="pagination.meta.last_page"
                :page-size="pagination.meta.per_page"
                hide-on-single-page
                @update:model-value="getData"
              />
            </div>
          </template>
          <template #cell(actions)="{ rowIndex }">
            <va-button
              v-for="(action, index) in customActions"
              :key="index"
              icon-color="text-primary"
              class="action-button ml-1 mr-1"
              preset="plain"
              :disabled="action.isDisabled(pagination.data[rowIndex])"
              :icon="action.icon"
              @click.prevent="action.click(pagination.data[rowIndex])"
            />
            <template v-if="crudable">
              <va-button preset="plain" icon="edit" @click.prevent="editModal(rowIndex)" />
              <va-button preset="plain" icon="delete" @click.prevent="deleteModal(rowIndex)" />
            </template>
          </template>
        </va-data-table>
        <CreateModal
          :form="form"
          :show="showModal"
          :schema="schema"
          @submit.prevent="submit"
          @modal:toggle="toggleModal"
        />
        <DeleteModal :show="showDeleteModal" @delete:confirm="deleteConfirm" @modal:toggle="toggleDeleteModal" />
      </div>
    </va-inner-loading>
  </div>
</template>

<script setup>
  import { onMounted, ref, defineEmits, computed, watch } from 'vue'
  import { Form } from 'vform'
  import axios from 'axios'
  import { useI18n } from 'vue-i18n'
  import { useToast, useColors } from 'vuestic-ui'
  import { useGlobalStore } from '../../stores/global-store'
  import CreateModal from '../modals/CreateModal.vue'
  import DeleteModal from '../modals/DeleteModal.vue'
  import Nameplate from '../nameplates/Nameplate.vue'
  import { mapSchemaToForm, matchWithSchema } from '../forms/utils'
  import { getStatusColor, getBooleanText, getBooleanColor } from '../../utils'
  import Date from '../date/Date.vue'
  import UserNameplate from '../nameplates/UserNameplate.vue'

  const { getColors } = useColors()
  const { init: initToast } = useToast()
  const colors = getColors()
  const { t } = useI18n()
  const { user } = useGlobalStore()

  const emit = defineEmits(['data:fetched'])

  const getHistoryAmountValue = (val) => {
    const sign = val.startsWith('-') ? '-' : '+'
    let num = val
    if (sign === '-') {
      num = val.slice(1)
    }
    num = Number(num).toFixed(3)
    if (!num) {
      return 0
    }
    return sign + num
  }

  const props = defineProps({
    crudable: {
      default: false,
      required: false,
      type: Boolean,
    },
    noData: {
      default: '',
      required: true,
      type: String,
    },
    customActions: { default: null, required: false, type: Array },
    endpoint: { default: '', requred: true, type: String },
    columns: { default: () => [], required: true, type: Array },
    schema: {
      default: () => [],
      required: false,
      type: Array,
    },
  })

  const isMinusCryptoAmount = (data) => {
    if (data.transaction_type === 'withdraw_transactions') {
      return true
    }
    if (data.transaction_type === 'subscription_transactions') {
      return true
    }
    if (data.transaction_type === 'transfer_transactions' && data.sender.username === user.username) {
      return true
    }
    return false
  }

  const endpointComputed = computed(() => {
    return props.endpoint
  })

  const noDataHtml = computed(() => {
    if (props.noData) {
      return props.noData
    }
    return `${t('tables.is_empty.no_data')}`
  })

  watch(endpointComputed, () => {
    getData()
  })

  const computedColumns = computed(() => {
    const cols = [...props.columns]
    if (props.crudable || props.customActions) {
      cols.push({ key: 'actions' })
    }
    return cols
  })

  const getHeading = (name) => {
    return t(`tables.headings.${name.toLowerCase()}`)
  }

  const getCellValue = (name) => {
    return t(`tables.cells.${name.toLowerCase()}`)
  }

  const submit = async () => {
    showModal.value = false
    if (editMode.value) {
      await form.value.put(`${endpointComputed.value}/${form.value.id}`)
    } else {
      await form.value.post(endpointComputed.value)
    }
    getData()
    selectedItem.value = null
    initToast({ message: t('createSuccess'), color: colors.success })
  }

  const createModal = () => {
    form.value.reset()
    selectedItem.value = null
    showModal.value = true
    editMode.value = false
  }

  const editModal = (idx) => {
    selectedItem.value = pagination.value.data[idx]
    showModal.value = true
    editMode.value = true
    form.value.fill(selectedItem.value)
  }

  const deleteModal = (idx) => {
    selectedItem.value = pagination.value.data[idx]
    showDeleteModal.value = true
  }

  const deleteConfirm = async () => {
    showDeleteModal.value = false
    await form.value.delete(`${endpointComputed.value}/${selectedItem.value.id}`)
    await getData()
    initToast({ message: t('delete.success'), color: colors.success })
  }

  const selectedItem = ref(null)
  const form = ref(new Form(mapSchemaToForm(props.schema)))
  const showModal = ref(false)
  const showDeleteModal = ref(false)
  const editMode = ref(false)

  const toggleModal = (value) => (showModal.value = value)
  const toggleDeleteModal = (value) => (showDeleteModal.value = value)
  const pagination = ref()

  const getData = async (page = 1) => {
    pagination.value = null
    const { data } = await axios.get(`${endpointComputed.value}?page=${page}`)
    data.data.forEach((item) => matchWithSchema(item, props.schema))
    pagination.value = data
    emit('data:fetched', data)
  }

  onMounted(getData)
</script>

<style lang="scss">
  .resource-table {
    --va-button-content-px: 0.3em;
    .action-button {
      .va-button__content {
        background: var(--va-background-element);
        padding-top: var(--va-button-content-px);
        padding-bottom: var(--va-button-content-px);
        background-color: var(--va-background-element);
      }
    }
    .avatar {
      height: 20px;
      width: 20px;
      border-radius: 50%;
    }
    .avatar-heading {
      justify-content: center;
    }

    .CryptoCurrency {
      display: flex;
      justify-content: center;
      align-items: center;
      &__Logo {
        width: 30px;
        height: 30px;
      }
    }
  }
</style>
