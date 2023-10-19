<template>
  <div class="faq-questions">
      <h3>{{ t(`faq.title`) }}</h3>

      <ul>
          <li v-for="question in questions" :key="question.id">
              <router-link :to="`/faq#question_${question.id}`">
                  {{ question.question }}
              </router-link>
          </li>
      </ul>
  </div>
</template>

<script setup>
  import { defineProps, onMounted, ref } from 'vue'
  import axios from 'axios'
  import { useI18n } from 'vue-i18n'

  const props = defineProps({
    categoryId: {
      type: Number,
      default: 1,
    },
  })
  const { t } = useI18n()

  const questions = ref()

  const getQuestionCategory = async () => {
    const { data } = await axios.get(`/api/question_category/${props.categoryId}`)
    questions.value = (data.data.questions)?.slice(0,5)
  }
  onMounted(getQuestionCategory)
</script>
