<template>
  <div class="profile">
    <div class="cent-nt">
      <h3>Редактирование профиля</h3>
    </div>

    <va-inner-loading :loading="!profile">
      <va-form enctype="multipart/form-data" tag="form" @submit.prevent="submit">
        <div class="row">
          <div class="flex xs12">
            <va-card>
              <va-card-content>
                <h3 class="title-redact">
                  <i class="fa fa-fw fa-user-circle"></i>
                  {{ t('profile.title') }}
                </h3>

                <div class="form-block">
                  <div class="text-form">{{ t('descriptions.profile') }}</div>
                  <div class="inputs-form">
                    <div class="input-group">
                      <label>{{ t(`forms.username`) }}</label>
                      <va-input
                        v-model="form['username']"
                        :error-messages="form.errors.get('username')"
                        :error="form.errors.has('username')"
                        disabled
                      />
                    </div>
                    <div class="input-group">
                      <label>{{ t(`forms.email`) }}</label>
                      <va-input
                        v-model="form['email']"
                        :error-messages="form.errors.get('email')"
                        :error="form.errors.has('email')"
                        disabled
                      />
                    </div>
                    <div class="input-group">
                      <label><b>*</b>{{ t(`forms.surname`) }}</label>
                      <va-input
                        v-model="form['surname']"
                        :style="{ color: colors.secondary }"
                        :error-messages="form.errors.get('surname')"
                        :error="form.errors.has('surname')"
                      />
                    </div>
                    <div class="input-group">
                      <label><b>*</b>{{ t(`forms.name`) }}</label>
                      <va-input
                        v-model="form['name']"
                        :style="{ color: colors.secondary }"
                        :error-messages="form.errors.get('name')"
                        :error="form.errors.has('name')"
                      />
                    </div>
                    <div class="input-group">
                      <label>{{ t(`forms.patronymic`) }}</label>
                      <va-input
                        v-model="form['patronymic']"
                        :style="{ color: colors.secondary }"
                        :error-messages="form.errors.get('patronymic')"
                        :error="form.errors.has('patronymic')"
                      />
                    </div>
                    <va-inner-loading :loading="!countries">
                      <div class="input-group">
                        <label>{{ t(`forms.country`) }}</label>
                        <va-select v-model="form['country']" :options="countries" />
                      </div>
                    </va-inner-loading>
                  </div>
                </div>

                <h3 class="title-redact">
                  <i class="fa fa-fw fa-redo-alt"></i>
                  {{ t('dividers.password_change') }}
                </h3>
                <div class="form-block">
                  <div class="text-form">{{ t('descriptions.password') }}</div>

                  <div class="inputs-form">
                    <div class="input-group">
                      <label>{{ t(`forms.new_password`) }}</label>
                      <va-input
                        v-model="form['password']"
                        :style="{ color: colors.secondary }"
                        :error-messages="form.errors.get('password')"
                        :error="form.errors.has('password')"
                        type="password"
                      />
                    </div>
                    <div class="input-group">
                      <label>{{ t(`forms.password_confirmation`) }}</label>
                      <va-input
                        v-model="form['password_confirmation']"
                        :style="{ color: colors.secondary }"
                        type="password"
                      />
                    </div>
                  </div>
                </div>

                <h3 class="title-redact">
                  <i class="fa fa-fw fa-user-plus"></i>
                  {{ t(`dividers.referral`) }}
                </h3>

                <div class="form-block">
                  <div class="text-form">{{ t('descriptions.referral') }}</div>
                  <div class="inputs-form">
                    <div v-if="profile && profile.sponsor_username" class="text-inner">
                      <div class="title-inner">{{ t('profile.your_sponsor') }}:</div>
                      <b>{{ profile.sponsor_username }}</b>
                    </div>
                    <div class="text-inner">
                      <div class="title-inner">{{ t('profile.invite_code') }}:</div>
                      <b>{{ profile ? profile.invite_code : '' }}</b>
                    </div>
                    <div class="text-inner">
                      <div class="title-inner">{{ t('profile.invite_link') }}:</div>
                      <b>{{
                        profile ? `${window.location.origin}/register?invite_code=${profile.invite_code}` : ''
                      }}</b>
                    </div>
                  </div>
                </div>

                <h3 class="title-redact">
                  <i class="fa fa-fw fa-user-plus"></i>
                  {{ t(`dividers.avatar`) }}
                </h3>

                <div class="form-block">
                  <div class="text-form">{{ t('descriptions.avatar') }}</div>
                  <div class="inputs-form">
                    <va-file-upload
                      v-model="form['avatar']"
                      file-types="image/*"
                      :upload-button-text="t('profile.upload_btn')"
                      type="single"
                    />
                  </div>
                </div>

                <h3 class="title-redact">
                  <i class="fa fa-fw fa-phone"></i>
                  {{ t(`dividers.connections`) }}
                </h3>
                <div class="form-block">
                  <div class="text-form">{{ t('descriptions.connections') }}</div>
                  <div class="inputs-form">
                    <div class="telegram">
                      <template v-if="telegramVal">
                        <va-input disabled :placeholder="t('profile.telegram_connected')">
                          <template #prependInner> <va-icon name="mail" /> </template>
                          <template #appendInner> <va-icon name="check" /> </template>
                        </va-input>
                        <va-button icon="edit" @click="disconnectTelegram">{{
                          t('profile.telegram_disconnect')
                        }}</va-button>
                      </template>
                      <template v-else>
                        <va-input
                          v-model="form.telegram"
                          :placeholder="t('profile.telegram_enter')"
                          :style="{ color: colors.secondary }"
                        />
                      </template>
                    </div>
                  </div>
                </div>

                <div class="submit-container">
                  <button type="submit" class="light-purple-button dark">
                    <i class="fa fa-fw fa-arrow-alt-circle-down"></i>
                    {{ t('profile.submit') }}
                  </button>
                </div>
              </va-card-content>
            </va-card>
          </div>
        </div>
      </va-form>
    </va-inner-loading>
  </div>
</template>

<script setup>
  import { useColors } from 'vuestic-ui'
  import { storeToRefs } from 'pinia'
  import { inject } from 'vue'
  import Form from 'vform'
  import axios from 'axios'
  import { useRoute } from 'vue-router'
  import { onMounted, ref } from 'vue'
  import { useI18n } from 'vue-i18n'
  import { useGlobalStore } from '../../stores/global-store'

  const GlobalStore = useGlobalStore()
  const { user } = storeToRefs(GlobalStore)
  const { colors } = useColors()
  const { params } = useRoute()
  const { t } = useI18n()
  const telegramVal = ref()

  const submit = async () => {
    form.value.country = form.value.country.value
    const { data } = await form.value.post(`/api/profile/${params.id}?_method=PUT`)
    telegramVal.value = data.data.telegram
    GlobalStore.changeUser(data.data)
  }

  const form = ref(
    new Form({
      username: '',
      email: '',
      name: '',
      surname: '',
      telegram: '',
      country: '',
      avatar: {},
      patronymic: '',
      password: '',
      password_confirmation: '',
    }),
  )
  const profile = ref()
  const countries = ref()
  const window = inject('window')

  const loadProfile = async () => {
    const { data } = await axios.get(`/api/profile/${params.id}`)
    await getCountries()
    profile.value = data.data
    form.value.fill(profile.value)
    telegramVal.value = profile.value.telegram
    form.value.avatar = []
    form.value.country = countries.value[data.data.country.id - 1]
    if (data.data.id === user.id) {
      GlobalStore.changeUser(data.data)
    }
  }

  const disconnectTelegram = () => {
    form.value.telegram = ''
    telegramVal.value = ''
  }

  const getCountries = async () => {
    const { data } = await axios.get('/api/country')
    countries.value = data.data.map((country) => ({ text: country.name, value: country.id }))
  }

  onMounted(loadProfile)
</script>

<style lang="scss">
  .telegram {
    flex-direction: unset;
    .va-input {
      opacity: initial;
    }
    .va-input__content__input {
      background-color: inherit;
    }
  }
</style>
