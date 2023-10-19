export default [
  {
    name: 'overview',
    path: '/admin/overview/',
    meta: {
      icon: 'info',
    },
  },
  {
    name: 'users',
    path: '/admin/users/',
    meta: {
      icon: 'group',
    },
  },
  {
    name: 'operations',
    disabled: true,
    meta: {
      icon: 'memory',
    },
    children: [
      {
        name: 'all_operations',
        path: '/admin/operations/all',
      },
      {
        name: 'deposit',
        path: '/admin/operations/deposit',
      },
      {
        name: 'dwithdraw',
        path: '/admin/operations/withdraw',
      },
    ],
  },
  {
    name: 'subscriptions',
    path: '/admin/subscriptions',
    meta: {
      icon: 'star',
    },
  },
  {
    name: 'support',
    path: '/admin/ticket',
    meta: {
      icon: 'support_agent',
    },
  },
  {
    name: 'categories',
    path: '/admin/categories',
    meta: {
      icon: 'category',
      isSuperAdmin: true,
    },
  },
  {
    name: 'products',
    path: '/admin/product',
    meta: {
      icon: 'shopping_bag',
      isSuperAdmin: true,
    },
  },
  {
    name: 'service',
    disabled: true,
    meta: {
      icon: 'build',
    },
    children: [
      {
        name: 'campaign',
        path: '/admin/campaign',
        meta: {
          icon: 'settings',
          isSuperAdmin: true,
        },
      },
      {
        name: 'bonus',
        path: '/admin/bonus',
        meta: {
          icon: 'payments',
          isSuperAdmin: true,
        },
      },
    ],
  },
]
