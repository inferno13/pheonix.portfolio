<template>
  <div class="va-chat">
    <div
      v-sticky-scroll="{
        animate: true,
        duration: 500,
      }"
      class="va-chat__body"
      :style="{ height: height }"
    >
      <div
        v-for="(message, index) in modelValue"
        :key="index"
        class="va-chat__message"
        :class="{ 'va-chat__message--yours': message.user_id === user.id }"
      >
        <div class="va-chat__message-user">
          <b>{{ message.username }}</b>
        </div>
        <div class="va-chat__message-text">
          {{ message.text }}
        </div>
        <div class="va-chat__message-date">
          <Date :date="message.created_at" />
        </div>
      </div>
    </div>
    <div class="va-chat__controls">
      <div class="input-group">
        <va-input
          v-model="inputMessage"
          :disabled="props.disabled"
          placeholder="Type your message..."
          class="va-chat__input mr-2"
          @keypress.enter="sendMessage"
        />
      </div>
      <button class="light-purple-button dark" :disabled="props.disabled" @click="sendMessage()">
        <i class="fa fa-fw fa-arrow-right" />
        {{ t('chat.send_button') }}
      </button>
    </div>
  </div>
</template>

<script setup>
  import vStickyScroll from './StickyScroll'
  import { ref } from 'vue'
  import { useI18n } from 'vue-i18n'
  import { useGlobalStore } from '../../stores/global-store'
  import { storeToRefs } from 'pinia'
  import Date from '../../components/date/Date.vue'

  const GlobalStore = useGlobalStore()
  const { t } = useI18n()

  const { user } = storeToRefs(GlobalStore)

  const props = defineProps({
    modelValue: { type: Array, default: () => [] },
    disabled: { type: Boolean, default: false },
  })

  const emit = defineEmits(['update:modelValue'])

  const inputMessage = ref('')

  function sendMessage() {
    if (!inputMessage.value) {
      return
    }
    emit(
      'update:modelValue',
      props.modelValue.concat({
        text: inputMessage.value,
        created_at: moment(),
        username: user.value.username,
        user_id: user.value.id,
      }),
    )
    inputMessage.value = ''
  }
</script>

<style lang="scss" scoped>
  $chat-message-br: 0.875rem;

  .va-chat {
    width: 100%;

    &__body {
      min-height: 18.75rem;
      display: flex;
      flex-direction: column;
      margin-bottom: 1.5rem;
      overflow-y: auto;
    }

    &__message {
      position: relative;
      padding: 0.657rem 1.375rem;
      margin-bottom: 0.625rem;
      max-width: 70%;
      overflow-wrap: break-word;
      border-top-left-radius: 0;
      align-self: flex-start;
      background-color: var(--va-background-primary);
      border-left: 6px solid var(--bs-purple);

      &-user,
      &-text {
        margin-bottom: 0.5em;
      }

      &-user,
      &-date {
        font-size: 0.875em;
      }

      &-text {
        display: block;
        transform: translateY(-2px);
      }

      &:last-child {
        margin-bottom: 0;
      }

      &--yours {
        border-left: none;
        border-right: 6px solid var(--bs-purple);
        align-self: flex-end;
      }
    }

    &__controls {
      display: flex;
      align-content: center;
    }

    &__input {
      flex-grow: 1;
      margin-bottom: 0;
    }
  }
</style>
