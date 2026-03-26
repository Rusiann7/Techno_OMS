import { createRouter, createWebHistory } from 'vue-router'
import { isAuthenticated } from '@/utils/auth'

const homePage = () => import('../view/homePage.vue')
const orderPage = () => import('../view/orderPage.vue')

const routes = [
  {
    path: '/',
    name: 'Homepage',
    component: homePage,
    meta: { title: 'Homepage', requiresAuth: false },
  },

  {
    path: '/order',
    name: 'Orderpage',
    component: orderPage,
    meta: { title: 'Order', requiresAuth: true },
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes: routes,
})

router.beforeEach((to, from, next) => {
  //jwt token auth guard and verification
  if (to.matched.some((record) => record.meta.requiresAuth)) {
    if (!isAuthenticated()) {
      next({ path: '/login', query: { redirect: to.fullPath } })
    } else {
      next()
    }
  } else {
    next()
  }

  if (to.meta?.title) {
    //display the title of the page
    document.title = to.meta.title
  }
})

export default router
