import { createRouter, createWebHistory } from 'vue-router'

const homePage = () => import('../view/homePage.vue')

const routes = [
  {
    path: '/',
    name: 'Homepage',
    component: homePage,
    meta: { title: 'Homepage' },
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes: routes,
})

export default router
