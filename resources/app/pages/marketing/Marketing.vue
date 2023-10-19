<template>
  <div class="cent-nt mkt-pull">
    <h3>Лидерский пулл</h3>
  </div>
  <va-inner-loading :loading="!marketing">
    <div v-if="marketing" class="marketing">
      <!-- First Pull -->
      <div class="pull-title">Пулл 1</div>
      <va-card class="pull">
        <div class="pull-item">
          <p class="title">Объём первой линии</p>
          <va-progress-circle size="150px" :model-value="firstPull">
            {{ firstPull + '%' }}
          </va-progress-circle>
          <p class="numbers">({{ marketing.user.first_pull_value }} / {{ marketing.first_pull_target }})</p>
        </div>
        <div class="pull-item">
          <p class="title">Объём первой и второй линии</p>
          <va-progress-circle size="150px" :model-value="firstPull">
            {{ secondPull + '%' }}
          </va-progress-circle>
          <p class="numbers">
            ({{ marketing.user.first_pull_value + marketing.user.second_pull_value }} /
            {{ marketing.first_and_second_pull_target }})
          </p>
        </div>
      </va-card>

      <div class="bot-container">
        <!-- Second Pull -->
        <div class="inner">
          <div class="pull-title">Пулл 2</div>

          <va-card class="pull">
            <div class="pull-item">
              <p class="title">Объём первой линии</p>
              <va-progress-circle size="150px" :model-value="firstPull">
                {{ firstPull + '%' }}
              </va-progress-circle>
              <p class="numbers">({{ marketing.user.first_pull_value }} / {{ marketing.first_pull_target }})</p>
            </div>
            <div class="pull-item">
              <p class="title">Партнёров c пуллом #1</p>
              <va-progress-circle size="150px" :model-value="firstPartners">
                {{ firstPartners + '%' }}
              </va-progress-circle>
              <p class="numbers">({{ marketing.user.first_partners }} / {{ marketing.first_partners_count_target }})</p>
            </div>
          </va-card>
        </div>

        <!-- Third Pull -->
        <div class="inner">
          <div class="pull-title">Пулл 3</div>

          <va-card class="pull">
            <div class="pull-item">
              <p class="title">Объём первой линии</p>
              <va-progress-circle size="150px" :model-value="firstPull">
                {{ firstPull + '%' }}
              </va-progress-circle>
              <p class="numbers">({{ marketing.user.first_pull_value }} / {{ marketing.first_pull_target }})</p>
            </div>
            <div class="pull-item">
              <p class="title">Партнёров c пуллом #2</p>
              <va-progress-circle size="150px" :model-value="secondPartners">
                {{ secondPartners + '%' }}
              </va-progress-circle>
              <p class="numbers">
                ({{ marketing.user.second_partners }} / {{ marketing.second_partners_count_target }})
              </p>
            </div>
          </va-card>
        </div>
      </div>
    </div>
  </va-inner-loading>
</template>

<script setup>
  import axios from 'axios'
  import { ref, onMounted } from 'vue'
  import { useI18n } from 'vue-i18n'
  const { t } = useI18n()
  const marketing = ref()
  const firstPull = ref()
  const firstPartners = ref()
  const secondPull = ref()
  const firstAndSecondPull = ref()
  const secondPartners = ref()
  const getMarketing = async () => {
    const { data } = await axios.get('/api/marketing')
    marketing.value = data.data
    firstPull.value = ((marketing.value.user.first_pull_value / marketing.value.first_pull_target) * 100).toFixed(2)
    firstPartners.value = (
      (marketing.value.user.first_partners / marketing.value.first_partners_count_target) *
      100
    ).toFixed(2)
    secondPartners.value = (
      (marketing.value.user.second_partners / marketing.value.second_partners_count_target) *
      100
    ).toFixed(2)
    secondPull.value = (marketing.value.user.second_pull_value / marketing.value.second_pull_target) * 100
    firstAndSecondPull.value =
      (marketing.value.user.first_pull_value + marketing.value.user.second_pull_value) /
      marketing.value.first_and_second_pull_target
  }

  onMounted(getMarketing)
</script>
