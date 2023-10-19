<template>
  <div class="clipboard-input-group" @click="doCopy">
      <div class="input-group">
          <va-input v-model="value" />
      </div>
      <p @click="doCopy">Нажмите, чтобы скопировать</p>
  </div>
</template>

<script>
  export default {
    props: {
      message: {
        default: '',
        type: String,
      },
    },
    data() {
      return {
        val: '',
      }
    },
    computed: {
      value: {
        get() {
          return this.message
        },
      },
    },
    methods: {
      doCopy: function () {
        this.$copyText(this.message)
      },
    },
  }
</script>
