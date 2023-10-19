<template>
  <div>123</div>
</template>

<script setup>
  import { ref, onMounted } from 'vue'
  import axios from 'axios'

  const partners = ref([])
  const maxLevel = ref(1)

  const getPartners = async () => {
    const { data } = await axios.get('/api/network')
    partners.value = data.data
    maxLevel.value = data.data.reduce((acc, cur) => (acc > cur.level ? acc : cur.level))
  }

  onMounted(getPartners)
</script>
