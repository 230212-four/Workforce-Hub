import { createRouter, createWebHistory } from 'vue-router';
import LoginPage from '../pages/auth/LoginPage.vue';
import RegisterPage from '../pages/auth/RegisterPage.vue';
import DashboardPage from '../pages/dashboard/DashboardPage.vue';
import KanbanPage from '../pages/kanban/KanbanPage.vue';

const routes = [
  { path: '/', redirect: '/login' },
  { path: '/login', name: 'login', component: LoginPage, meta: { layout: 'empty' } },
  { path: '/register', name: 'register', component: RegisterPage, meta: { layout: 'empty' } },
  { path: '/dashboard', name: 'dashboard', component: DashboardPage, meta: { layout: 'app' } },
  { path: '/kanban', name: 'kanban', component: KanbanPage, meta: { layout: 'app' } }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
