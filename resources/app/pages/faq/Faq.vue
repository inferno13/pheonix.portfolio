<template>
  <va-inner-loading :loading="!categories">
    <nav class="bg-nt fq">
      <h3>FAQ</h3>

      <span>
        База знаний
        <span class="slash">/</span>
        FAQ
      </span>
    </nav>

    <div v-if="categories" class="faq">
      <div v-for="(category, index) in categories" :key="category.id" class="row cards-container">
        <va-card class="faq-card">
          <h3>
            {{ `${index + 1}. ${category.name}` }}
          </h3>
          <va-accordion class="faq-accordion">
            <va-collapse
              v-for="question in category.questions"
              :id="`question_${question.id}`"
              :key="question.id"
              :header="question.question"
            >
              <div class="show-block">
                {{ question.answer }}
              </div>
            </va-collapse>
          </va-accordion>
        </va-card>
      </div>
    </div>
  </va-inner-loading>
</template>

<script setup>
  import { ref, onMounted, nextTick } from 'vue'
  import axios from 'axios'
  import { useRoute } from 'vue-router'
  const { hash } = useRoute()
  const categories = ref()

  const getQuestions = async () => {
    const { data } = await axios.get('/api/question_category')
    categories.value = data.data
    await nextTick(() => {
      if (hash) {
        document.querySelector(hash).scrollIntoView({ block: 'center', behavior: 'smooth' })
      }
    })
  }

  onMounted(getQuestions)
</script>
