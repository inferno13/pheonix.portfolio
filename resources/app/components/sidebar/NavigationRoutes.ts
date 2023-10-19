export interface INavigationRoute {
  name: string
  displayName: string
  type: string
  meta: { icon: string }
  children?: INavigationRoute[]
}

export default {
  root: {
    name: '/',
    displayName: 'navigationRoutes.home',
  },
  routes: [
    {
      name: 'dashboard',
      displayName: 'menu.dashboard',
      type: 'link',
      meta: {
        icon: 'dashboard',
      },
    },
    {
      name: 'products',
      displayName: 'menu.products',
      type: 'link',
      meta: {
        icon: 'shopping_bag',
      },
    },
    {
      name: 'subscriptions',
      type: 'link',
      displayName: 'menu.subscriptions',
      meta: {
        icon: 'star',
      },
    },
    {
      name: 'distributions',
      type: 'link',
      displayName: 'menu.distributions',
      meta: {
        icon: 'description',
      },
    },
    {
      displayName: 'menu.finance',
      type: 'header',
    },
    {
      name: 'deposit',
      type: 'link',
      displayName: 'menu.deposit',
      meta: {
        icon: 'south',
      },
    },
    {
      name: 'withdraw',
      type: 'link',
      displayName: 'menu.withdraw',
      meta: {
        icon: 'north',
      },
    },
    {
      name: 'transfer',
      type: 'link',
      displayName: 'menu.transfer',
      meta: {
        icon: 'sync_alt',
      },
    },
    {
      name: 'history',
      type: 'link',
      displayName: 'menu.history',
      meta: {
        icon: 'history',
      },
    },
    {
      displayName: 'menu.partner_network',
      type: 'header',
    },
    {
      name: 'partners',
      type: 'link',
      displayName: 'menu.partners',
      meta: {
        icon: 'handshake',
      },
    },
    {
      name: 'marketing',
      type: 'link',
      displayName: 'menu.marketing',
      meta: {
        icon: 'leaderboard',
      },
    },
    {
      name: 'line',
      type: 'link',
      displayName: 'menu.line',
      meta: {
        icon: 'family_history',
      },
    },
    {
      displayName: 'menu.knowledge_base',
      type: 'header',
    },
    {
      name: 'education',
      type: 'link',
      displayName: 'menu.education',
      groups: ['user', 'admin', 'superadmin'],
      meta: {
        icon: 'school',
      },
    },
    {
      name: 'faq',
      type: 'link',
      displayName: 'menu.faq',
      groups: ['user', 'admin', 'superadmin'],
      meta: {
        icon: 'quiz',
      },
    },
    {
      displayName: 'menu.help',
      type: 'header',
    },
    {
      name: 'support',
      type: 'link',
      displayName: 'menu.support',
      groups: ['user', 'admin', 'superadmin'],
      meta: {
        icon: 'support_agent',
      },
    },
  ] as INavigationRoute[],
}
