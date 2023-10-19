import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'
import AppLayout from '../layouts/AppLayout.vue'
import Page404Layout from '../layouts/Page404Layout.vue'
import RouteViewComponent from '../layouts/RouterBypass.vue'

const routes: Array<RouteRecordRaw> = [
  {
    path: '/:catchAll(.*)',
    redirect: { name: 'dashboard' },
  },
  {
    name: 'Entry Point',
    path: '/',
    component: AppLayout,
    children: [
      {
        name: 'admin',
        path: 'admin',
        component: RouteViewComponent,
        children: [
          {
            name: 'overview',
            path: 'overview',
            component: () => import('../pages/admin/overview/Overview.vue'),
          },
          {
            name: 'bonus',
            path: 'bonus',
            component: () => import('../pages/admin/bonus/Bonus.vue'),
          },
          {
            name: 'campaign',
            path: 'campaign',
            component: () => import('../pages/admin/campaign/Campaign.vue'),
          },
          {
            name: 'admin-subscriptions',
            path: 'subscriptions',
            component: () => import('../pages/admin/subscription/Subscription.vue'),
          },
          {
            name: 'admin-product',
            path: 'product',
            component: () => import('../pages/admin/product/Product.vue'),
          },
          {
            name: 'admin-ticket',
            path: 'ticket',
            component: () => import('../pages/admin/ticket/Ticket.vue'),
          },
          {
            name: 'users',
            path: 'users',
            component: () => import('../pages/admin/users/Users.vue'),
          },
          {
            name: 'categories',
            path: 'categories',
            component: () => import('../pages/admin/category/CategoryList.vue'),
          },
          {
            name: 'operations',
            path: 'operations',
            component: RouteViewComponent,
            children: [
              {
                name: 'all_operations',
                path: 'all',
                component: () => import('../pages/admin/operations/all/All.vue'),
              },
              {
                name: 'woperations',
                path: 'withdraw',
                component: () => import('../pages/admin/operations/withdraw/Withdraw.vue'),
              },
              {
                name: 'doperations',
                path: 'deposit',
                component: () => import('../pages/admin/operations/deposit/Deposit.vue'),
              },
            ],
          },
        ],
      },
      {
        name: 'dashboard',
        path: 'dashboard',
        component: () => import('../pages/dashboard/Dashboard.vue'),
      },
      {
        name: 'notifications',
        path: 'notifications',
        component: () => import('../pages/notification/Notification.vue'),
      },
      {
        name: 'distributions',
        path: 'distributions',
        component: () => import('../pages/distribution/Distribution.vue'),
      },
      {
        name: 'profile',
        path: 'profile/:id',
        component: () => import('../pages/profile/Profile.vue'),
      },
      {
        name: 'activity',
        path: 'activity',
        component: () => import('../pages/activity/Activity.vue'),
      },
      {
        name: 'chat',
        path: 'chat/:id',
        component: () => import('../pages/chat/ChatPage.vue'),
      },
      {
        name: 'wallet',
        path: 'wallet',
        component: RouteViewComponent,
        children: [
          {
            name: 'deposit',
            path: 'deposit',
            component: () => import('../pages/wallet/deposit/Deposit.vue'),
          },
          {
            name: 'depositMethod',
            path: 'deposit/method/:id',
            component: () => import('../pages/wallet/deposit/DepositMethod.vue'),
          },
          {
            name: 'depositTransaction',
            path: 'deposit/transaction/:id',
            component: () => import('../pages/wallet/deposit/DepositTransaction.vue'),
          },
          {
            name: 'transfer',
            path: 'transfer',
            component: () => import('../pages/wallet/transfer/Transfer.vue'),
          },
          {
            name: 'withdraw',
            path: 'withdraw',
            component: () => import('../pages/wallet/withdraw/Withdraw.vue'),
          },
          {
            name: 'history',
            path: 'history',
            component: () => import('../pages/wallet/history/History.vue'),
          },
        ],
      },
      {
        name: 'network',
        path: 'network',
        component: RouteViewComponent,
        children: [
          {
            name: 'partners',
            path: 'partners',
            component: () => import('../pages/network/partner/Partner.vue'),
          },
          {
            name: 'line',
            path: 'line',
            component: () => import('../pages/network/line/Line.vue'),
          },
        ],
      },
      {
        name: 'products',
        path: 'products',
        component: () => import('../pages/product/Product.vue'),
      },
      {
        name: 'productDescription',
        path: 'products/description/:id',
        component: () => import('../pages/product/ProductDescription.vue'),
      },
      {
        name: 'subscriptions',
        path: 'subscriptions',
        component: () => import('../pages/subscription/SubscriptionList.vue'),
      },
      {
        name: 'subscription_manage',
        path: 'subscriptions/manage/:id',
        component: () => import('../pages/subscription/Subscription.vue'),
      },
      {
        name: 'support',
        path: 'support',
        component: () => import('../pages/support/Support.vue'),
      },
      {
        name: 'education',
        path: 'education',
        component: () => import('../pages/education/Education.vue'),
      },
      {
        name: 'marketing',
        path: 'marketing',
        component: () => import('../pages/marketing/Marketing.vue'),
      },
      {
        name: 'faq',
        path: 'faq',
        component: () => import('../pages/faq/Faq.vue'),
      },
    ],
  },
]

const router = createRouter({
  history: createWebHistory('/'),
  routes,
})

export default router
