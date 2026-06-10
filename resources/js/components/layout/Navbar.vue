<script setup>
import { ref, inject, onMounted, onBeforeUnmount, watch } from 'vue'
import { useRouter } from 'vue-router'
import { useNotifications } from '../../composables/useNotifications'
import { useAuth } from '../../composables/useAuth'
import { useDarkMode } from '../../composables/useDarkMode'
import NotificationDrawer from './NotificationDrawer.vue'
import AccountSettingsModal from '../settings/AccountSettingsModal.vue'
import WorkspaceSwitcherModal from '../settings/WorkspaceSwitcherModal.vue'

const emit = defineEmits(['toggle-sidebar'])

const router = useRouter()
const { hasUnread, loadNotifications } = useNotifications()
const { currentUser, isAdmin, avatarInitial, displayName, roleLabel, logout } = useAuth()
const { isDarkMode, toggleDarkMode } = useDarkMode()

const showNotifications     = ref(false)
const showAccountSettings   = ref(false)
const showWorkspaceSwitcher = ref(false)
let refreshTimer = null

// ── Notification Drawer ──
const openNotificationDrawer = async () => {
  showNotifications.value = true
  await loadNotifications()
}

const closeNotificationDrawer = () => {
  showNotifications.value = false
}

// When a notification is clicked that links to a task, open the EditTaskModal
const openEditModal = inject('openEditModal')

const handleNotificationTaskOpen = (task) => {
  closeNotificationDrawer()
  if (task && openEditModal) {
    openEditModal(task)
  }
}

const openAccountSettings  = () => { showAccountSettings.value = true  }
const closeAccountSettings = () => { showAccountSettings.value = false }

const openWorkspaceSwitcher = () => {
  showWorkspaceSwitcher.value = true
}

const closeWorkspaceSwitcher = () => {
  showWorkspaceSwitcher.value = false
}

const goToSettings = () => {
  router.push('/settings')
}

const handleLogout = async () => {
  await logout()
  router.push('/login')
}

watch(
  () => currentUser.value.id,
  async (id) => {
    if (id) {
      await loadNotifications()
    }
  },
  { immediate: true }
)

onMounted(() => {
  refreshTimer = window.setInterval(() => {
    if (currentUser.value.id) {
      loadNotifications().catch(() => {})
    }
  }, 45000)
})

onBeforeUnmount(() => {
  if (refreshTimer) {
    window.clearInterval(refreshTimer)
  }
})
</script>

<template>
  <header class="h-14 bg-neoCard brut-border border-l-0 border-t-0 flex items-center justify-between px-4 sticky top-0 z-10">
    <!-- Left: Hamburger (mobile) + Breadcrumb (desktop) -->
    <div class="flex items-center gap-3">
      <!-- Hamburger — visible on mobile only -->
      <button
        id="sidebar-hamburger"
        @click="$emit('toggle-sidebar')"
        class="md:hidden w-10 h-10 brut-border bg-neoCard flex flex-col items-center justify-center gap-1.5 brut-hover cursor-pointer flex-shrink-0"
        aria-label="Open navigation menu"
      >
        <span class="w-5 h-0.5 bg-ink block"></span>
        <span class="w-5 h-0.5 bg-ink block"></span>
        <span class="w-5 h-0.5 bg-ink block"></span>
      </button>

      <!-- Breadcrumb — desktop only -->
      <div class="hidden md:flex items-center gap-2">
        <span class="text-xs font-black uppercase tracking-wider text-neoMuted">Workspace</span>
        <span class="text-xs text-neoMuted">/</span>
        <span class="text-xs font-black uppercase tracking-wider text-ink">{{ currentUser?.workspace?.name || 'No Workspace' }}</span>
        <button
          v-if="isAdmin"
          id="workspace-switch-button"
          @click="openWorkspaceSwitcher"
          class="h-8 px-3 ml-2 brut-border bg-neoCard flex items-center justify-center brut-hover cursor-pointer text-[0.65rem] font-black uppercase tracking-wide text-ink"
          title="Switch Workspace"
        >
          Switch
        </button>
      </div>

      <!-- Mobile logo fallback (shown when hamburger present) -->
      <div class="font-black uppercase tracking-wide text-ink text-sm md:hidden">Workforce Hub</div>
    </div>

    <!-- Right: Action Buttons -->
    <div class="flex items-center gap-2">
      <div
        class="hidden sm:flex h-10 items-center gap-2 px-3 brut-border bg-neoCard text-xs font-black uppercase tracking-wide text-ink"
      >
        <span class="w-2.5 h-2.5 rounded-full" :class="isAdmin ? 'bg-neoPink' : 'bg-neoMint'"></span>
        <span>{{ roleLabel }}</span>
      </div>

      <!-- ── Dark Mode Toggle ────────────────────────────────────── -->
      <button
        id="theme-toggle"
        @click="toggleDarkMode"
        class="w-10 h-10 brut-border bg-neoCard flex items-center justify-center brut-hover cursor-pointer"
        :title="isDarkMode ? 'Switch to Light Mode' : 'Switch to Dark Mode'"
        :aria-label="isDarkMode ? 'Switch to Light Mode' : 'Switch to Dark Mode'"
      >
        <!-- Sun icon (shown in dark mode — click for light) -->
        <svg
          v-if="isDarkMode"
          class="w-[18px] h-[18px] text-ink theme-icon-spin"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24"
          stroke-width="2.5"
        >
          <circle cx="12" cy="12" r="5" />
          <line x1="12" y1="1" x2="12" y2="3" />
          <line x1="12" y1="21" x2="12" y2="23" />
          <line x1="4.22" y1="4.22" x2="5.64" y2="5.64" />
          <line x1="18.36" y1="18.36" x2="19.78" y2="19.78" />
          <line x1="1" y1="12" x2="3" y2="12" />
          <line x1="21" y1="12" x2="23" y2="12" />
          <line x1="4.22" y1="19.78" x2="5.64" y2="18.36" />
          <line x1="18.36" y1="5.64" x2="19.78" y2="4.22" />
        </svg>
        <!-- Moon icon (shown in light mode — click for dark) -->
        <svg
          v-else
          class="w-[18px] h-[18px] text-ink theme-icon-spin"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24"
          stroke-width="2.5"
        >
          <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" />
        </svg>
      </button>

      <!-- Notification Bell -->
      <div class="relative">
        <button
          id="notification-bell"
          @click="openNotificationDrawer"
          class="w-10 h-10 brut-border bg-neoCard flex items-center justify-center brut-hover cursor-pointer"
        >
          <svg class="w-[18px] h-[18px] text-ink" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" /><path d="M13.73 21a2 2 0 0 1-3.46 0" />
          </svg>
          <span v-if="hasUnread" class="notification-dot"></span>
        </button>
      </div>

      <!-- Settings Gear -->
      <button
        id="settings-button"
        @click="goToSettings"
        class="w-10 h-10 brut-border bg-neoCard flex items-center justify-center brut-hover cursor-pointer"
      >
        <svg class="w-[18px] h-[18px] text-ink" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
          <circle cx="12" cy="12" r="3" /><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z" />
        </svg>
      </button>

      <!-- Admin Workspace Switch -->
      <button
        v-if="isAdmin"
        id="workspace-switch-mobile"
        @click="openWorkspaceSwitcher"
        class="md:hidden w-10 h-10 brut-border bg-neoCard flex items-center justify-center brut-hover cursor-pointer"
        title="Switch Workspace"
        aria-label="Switch Workspace"
      >
        <svg class="w-[18px] h-[18px] text-ink" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
          <path d="M4 19.5V4.5A1.5 1.5 0 0 1 5.5 3h13A1.5 1.5 0 0 1 20 4.5v15" />
          <path d="M4 19.5A1.5 1.5 0 0 0 5.5 21h13a1.5 1.5 0 0 0 1.5-1.5" />
          <path d="M8 7h8" />
          <path d="M8 11h8" />
          <path d="M8 15h5" />
        </svg>
      </button>

      <!-- User Avatar — click to open Account Settings -->
      <button
        id="user-avatar"
        :class="[
          'w-10 h-10 brut-border flex items-center justify-center font-black text-ink text-sm cursor-pointer brut-hover',
          isAdmin ? 'bg-neoPink' : 'bg-neoMint'
        ]"
        @click="openAccountSettings"
        :title="displayName || roleLabel"
      >
        {{ avatarInitial }}
      </button>

      <!-- Logout — hidden on very small screens to avoid overflow -->
      <button
        id="logout-button"
        @click="handleLogout"
        class="hidden sm:flex h-10 px-4 brut-border bg-neoCard items-center gap-2 font-black text-xs uppercase tracking-wide text-ink brut-hover cursor-pointer"
      >
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
          <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" /><polyline points="16,17 21,12 16,7" /><line x1="21" y1="12" x2="9" y2="12" />
        </svg>
        LOGOUT
      </button>
    </div>
  </header>

  <!-- Notification Drawer (Teleported inside the component itself) -->
  <NotificationDrawer
    :isOpen="showNotifications"
    @close="closeNotificationDrawer"
    @open-task="handleNotificationTaskOpen"
  />

  <!-- Account Settings Modal (teleported outside header flow) -->
  <AccountSettingsModal
    :isOpen="showAccountSettings"
    @close="closeAccountSettings"
  />

  <WorkspaceSwitcherModal
    :isOpen="showWorkspaceSwitcher"
    @close="closeWorkspaceSwitcher"
  />
</template>
