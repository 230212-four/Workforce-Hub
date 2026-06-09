import { createRouter, createWebHistory } from 'vue-router';
import { hydrateAuth, useAuth } from '../composables/useAuth';
import LoginPage from '../pages/auth/LoginPage.vue';
import RegisterPage from '../pages/auth/RegisterPage.vue';
import DashboardPage from '../pages/dashboard/DashboardPage.vue';
import KanbanPage from '../pages/kanban/KanbanPage.vue';
import SettingsPage from '../pages/settings/SettingsPage.vue';
import AccountSettingsPage from '../pages/settings/AccountSettingsPage.vue';
import ManageWorkspacePage from '../pages/workspace/ManageWorkspacePage.vue';
import UserManagementPage from '../pages/admin/UserManagementPage.vue';

const routes = [
  { path: '/', redirect: '/login' },
  { path: '/login', name: 'login', component: LoginPage, meta: { layout: 'empty' } },
  { path: '/register', name: 'register', component: RegisterPage, meta: { layout: 'empty' } },
  { path: '/dashboard', name: 'dashboard', component: DashboardPage, meta: { layout: 'app', requiresAuth: true } },
  { path: '/kanban', name: 'kanban', component: KanbanPage, meta: { layout: 'app', requiresAuth: true } },
  { path: '/settings', name: 'settings', component: SettingsPage, meta: { layout: 'app', requiresAuth: true } },
  { path: '/account', name: 'account', component: AccountSettingsPage, meta: { layout: 'app', requiresAuth: true } },
  { path: '/workspace', name: 'workspace', component: ManageWorkspacePage, meta: { layout: 'app', requiresAuth: true, requiresAdmin: true } },
  { path: '/admin/users', name: 'admin-users', component: UserManagementPage, meta: { layout: 'app', requiresAuth: true, requiresAdmin: true } }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

// Navigation guard: keep private routes behind an authenticated session.
router.beforeEach(async (to, from, next) => {
  await hydrateAuth().catch(() => {})

  const { isAuthenticated, isAdmin } = useAuth()

  if (to.meta.requiresAuth && !isAuthenticated.value) {
    next({ name: 'login' })
    return
  }

  if (to.meta.requiresAdmin && !isAdmin.value) {
    next({ name: 'dashboard' })
    return
  }

  next()
})

export default router;
