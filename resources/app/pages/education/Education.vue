<template>
  <va-inner-loading :loading="!educationList">
    <nav class="bg-nt educ">
      <h3>Обучение</h3>

      <span>
        База знаний
        <span class="slash">/</span>
        Обучение
      </span>
    </nav>

    <div v-if="educationList" class="education">
      <div class="education-container">
        <div v-if="lessons.length > 0" class="lessons-container">
          <va-card class="videos-container">
            <div v-for="(lesson, index) in lessons" :key="lesson.id" class="lesson">
              <div class="left-img">
                <div
                  v-if="!lesson.is_clicked && lesson.is_unlocked"
                  class="container lesson__toclick"
                  @click="() => lessonClicked(lesson)"
                >
                  <!-- <i class="fa fa-lock-open"></i> -->
                  <span class="lesson__index">{{ index + 1 < 10 ? 0 : '' }}{{ index + 1 }}</span>
                </div>
                <div v-else-if="lesson.is_unlocked" class="lesson__video">
                  <video-player
                    class="lesson__player"
                    :poster="lesson.poster"
                    :src="lesson.src"
                    controls
                    :volume="0.6"
                    @ended="onEnded(lesson.next)"
                  />
                </div>
                <div v-else class="container">
                  <i class="fa fa-lock"></i>
                </div>
              </div>
              <div class="lesson__info">
                <header class="d-flex">
                  <div class="lesson__number">Урок {{ index + 1 }}</div>
                  <div class="lesson__duration">
                    <va-icon tag="span" name="schedule" />
                    <div>{{ lesson.duration }}</div>
                  </div>
                </header>
                <h2 class="lesson__title">{{ lesson.title }}</h2>
                <div class="lesson__description">{{ lesson.description }}</div>
              </div>
            </div>
          </va-card>
        </div>
      </div>
    </div>
  </va-inner-loading>
</template>

<script setup>
  import { onMounted, ref, watch } from 'vue'
  import axios from 'axios'
  const educationList = ref()
  const currentTab = ref(0)

  const lessons = ref()

  const onEnded = async (idx) => {
    if (idx) {
      await axios.put(`/api/lesson/${idx}`, { isUnlocked: true })
      getEducationList()
    }
  }

  const lessonClicked = (lesson) => {
    lesson.is_clicked = true
  }

  watch([currentTab, educationList], ([currentTab, currentEducationList]) => {
    getEducation(currentEducationList[currentTab].id)
  })

  const getEducation = async (id) => {
    const { data } = await axios.get(`/api/education/${id}`)
    lessons.value = data.data.lessons
  }

  const getEducationList = async () => {
    const { data } = await axios.get('/api/education')
    educationList.value = data.data
  }

  onMounted(getEducationList)
</script>

<style lang="scss">
  .education {
    .lesson {
      padding: 1em;
      display: flex;

      &__number {
        margin-right: 0.5em;
      }

      &__index {
        color: #fff;
        font-weight: bold;
        font-size: 2em;
      }

      &__toclick {
        cursor: pointer;
      }

      &__duration {
        display: flex;
      }

      &__title,
      &__description {
        margin-top: 0.5em;
      }

      &__description {
        margin-top: 0.5em;
        font-size: 0.825em;
      }

      &__block {
        &--flex {
          display: flex;
        }
      }

      &__video,
      &__info {
        padding: 1em;
      }

      &__player {
        width: 400px;
        height: 200px;

        &--locked {
          background-image: url('data:image/svg+xml;utf-8,<svg xmlns="http://www.w3.org/2000/svg" height="48" width="48"><path d="M11 44q-1.25 0-2.125-.875T8 41V19.3q0-1.25.875-2.125T11 16.3h3.5v-4.8q0-3.95 2.775-6.725Q20.05 2 24 2q3.95 0 6.725 2.775Q33.5 7.55 33.5 11.5v4.8H37q1.25 0 2.125.875T40 19.3V41q0 1.25-.875 2.125T37 44Zm0-3h26V19.3H11V41Zm13-7q1.6 0 2.725-1.1t1.125-2.65q0-1.5-1.125-2.725T24 26.3q-1.6 0-2.725 1.225T20.15 30.25q0 1.55 1.125 2.65Q22.4 34 24 34Zm-6.5-17.7h13v-4.8q0-2.7-1.9-4.6Q26.7 5 24 5q-2.7 0-4.6 1.9-1.9 1.9-1.9 4.6ZM11 41V19.3 41Z"/></svg>');
          background-repeat: no-repeat;
          background-position: center;
          background-color: var(--va-on-background-primary);
        }
      }
    }

    .vjs-big-play-button {
      top: 50%;
      left: 50%;
      transform: translateY(-50%) translateX(-50%);
    }

    .divider {
      width: 100%;
    }
    .video-title {
      flex: 1 1 100%;
    }
    .video-player {
      width: 400px;
      height: 200px;
    }
  }
</style>
