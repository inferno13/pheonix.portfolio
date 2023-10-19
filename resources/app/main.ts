import { createApp } from 'vue'
import axios from 'axios'
import i18n from './i18n'
import { createVuestic } from 'vuestic-ui'
import { createGtm } from '@gtm-support/vue-gtm'
import VueClipboard from 'vue-clipboard2'
import VueSweetalert2 from 'vue-sweetalert2'
import VueVideoPlayer from '@videojs-player/vue'

import stores from './stores'
import router from './router'
import vuesticGlobalConfig from './services/vuestic-ui/global-config'
import App from './App.vue'

axios.defaults.withCredentials = true
const app = createApp(App)

app.use(VueSweetalert2)
app.use(stores)
app.use(router)
app.use(i18n)
app.use(VueVideoPlayer)
app.use(createVuestic({ config: vuesticGlobalConfig }))
app.provide('window', window)

VueClipboard.config.autoSetContainer = true
app.use(VueClipboard)

if (import.meta.env.VITE_APP_GTM_ENABLED) {
  app.use(
    createGtm({
      id: import.meta.env.VITE_APP_GTM_KEY,
      debug: false,
      vueRouter: router,
    }),
  )
}

app.mount('#app')
