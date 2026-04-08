import { createRouter, createWebHistory } from 'vue-router'
import { isAuthenticated } from '@/utils/auth'

const homePage = () => import('../view/homePage.vue')
const adminPage = () => import('../view/adminPage.vue')
const logIn = () => import('../view/landingPage.vue')
const pageError = () => import('../view/notFound.vue')
const loginAdmin = () => import('../view/adminLogin.vue')
const test = () => import('../view/test.vue')

const routes = [
  {
    path: '/',
    name: 'Homepage',
    component: homePage,
    meta: { title: 'Homepage', requiresAuth: false },
  },

  {
    path: '/admin',
    name: 'adminPage',
    component: adminPage,
    meta: { title: 'Admin', requiresAuth: true },
  },

  {
    path: '/login',
    name: 'logIn',
    component: logIn,
    meta: { title: 'Login', requiresAuth: false },
  },

  {
    path: '/login-admin',
    name: 'loginAdmin',
    component: loginAdmin,
    meta: { title: 'Login', requiresAuth: false },
  },

  {
    path: '/:pathMatch(.*)*',
    name: 'errorPage',
    component: pageError,
    meta: { title: '404 Error', requiresAuth: false },
  },

  {
    path: '/testtesttest',
    name: 'testPage',
    component: test,
    meta: { title: 'test', requiresAuth: false },
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
