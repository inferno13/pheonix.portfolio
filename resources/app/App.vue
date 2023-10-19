<template>
  <router-view />
</template>

<script setup>
  import { useGlobalStore } from './stores/global-store'
  import Echo from 'laravel-echo'
  import Pusher from 'pusher-js'

  const GlobalStore = useGlobalStore()

  window.Pusher = Pusher
  window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
  })

  GlobalStore.getUser()
</script>

<style lang="scss">
  @import 'scss/main.scss';
  //css kdubasov
  @import 'css-kdubasov/buttons.css';
  @import 'css-kdubasov/tables.css';
  @import 'css-kdubasov/index.css';
  @import 'css-kdubasov/forms.css';
  @import 'css-kdubasov/modals.css';
  //components
  @import 'css-kdubasov/components/navbar-top.css';
  @import 'css-kdubasov/components/navTops.css';
  @import 'css-kdubasov/components/sidebar.css';
  //pages
  @import 'css-kdubasov/pages/products.css';
  @import 'css-kdubasov/pages/activity.css';
  @import 'css-kdubasov/pages/dashboard.css';
  @import 'css-kdubasov/pages/profile.css';
  @import 'css-kdubasov/pages/wallet/deposit.css';
  @import 'css-kdubasov/pages/wallet/deposyMethod.css';
  @import 'css-kdubasov/pages/wallet/transfer.css';
  @import 'css-kdubasov/pages/wallet/withdraw.css';
  @import 'css-kdubasov/pages/wallet/history.css';
  @import 'css-kdubasov/pages/partner.css';
  @import 'css-kdubasov/pages/faq.css';
  @import 'css-kdubasov/pages/education.css';
  @import 'css-kdubasov/pages/marketing.css';
  @import 'css-kdubasov/pages/support.css';
  @import 'css-kdubasov/components/adminNavbar.css';
  @import 'css-kdubasov/pages/subscription.css';
  @import 'css-kdubasov/pages/subscriptionRedact.css';
  @import 'css-kdubasov/pages/chat.css';
  @import 'css-kdubasov/pages/distributions.css';
  @import 'css-kdubasov/pages/productDescriptions.css';
  //admin pages
  @import 'css-kdubasov/pages/admin/ticket.css';
  @import 'css-kdubasov/pages/admin/overview.css';
  @import 'css-kdubasov/pages/admin/users.css';
  @import 'css-kdubasov/pages/admin/deposit.css';

  #app {
    font-family: 'Source Sans Pro', Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    color: #2c3e50;
  }

  body {
    margin: 0;
  }
</style>
