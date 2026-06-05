<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useNotifications } from '../../composables/useNotifications'
import { useAuth } from '../../composables/useAuth'
import NotificationDropdown from './NotificationDropdown.vue'

const emit = defineEmits(['toggle-sidebar'])

const router = useRouter()
const { hasUnread } = useNotifications()
const { currentUser, isAdmin, toggleRole } = useAuth()

const showNotifications = ref(false)

const toggleNotifications = () => {
  showNotifications.value = !showNotifications.value
}

const closeNotifications = () => {
  showNotifications.value = false
}

const goToSettings = () => {
  router.push('/settings')
}

const logout = () => {
  router.push('/login')
}
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
        <span class="text-xs font-black uppercase tracking-wider text-ink">iReply Services</span>
      </div>

      <!-- Mobile logo fallback (shown when hamburger present) -->
      <div class="font-black uppercase tracking-wide text-ink text-sm md:hidden">Workforce Hub</div>
    </div>

    <!-- Right: Action Buttons -->
    <div class="flex items-center gap-2">
      <!-- Role Toggle Pill -->
      <button
        id="role-toggle"
        @click="toggleRole"
        :class="[
          'role-toggle-pill',
          isAdmin ? 'bg-neoIndigo text-white' : 'bg-neoMint text-ink'
        ]"
        :title="'Switch to ' + (isAdmin ? 'User' : 'Admin') + ' view'"
      >
        <span class="role-indicator" :style="{ background: isAdmin ? '#fff' : 'var(--ink)' }"></span>
        <span class="hidden sm:inline">{{ isAdmin ? 'ADMIN' : 'USER' }}</span>
        <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
          <path d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
        </svg>
      </button>

      <!-- Notification Bell -->
      <div class="relative">
        <button
          id="notification-bell"
          @click="toggleNotifications"
          class="w-10 h-10 brut-border bg-neoCard flex items-center justify-center brut-hover cursor-pointer"
        >
          <svg class="w-[18px] h-[18px] text-ink" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" /><path d="M13.73 21a2 2 0 0 1-3.46 0" />
          </svg>
          <span v-if="hasUnread" class="notification-dot"></span>
        </button>
        <!-- Notification Dropdown -->
        <NotificationDropdown
          :isOpen="showNotifications"
          @close="closeNotifications"
        />
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

      <!-- User Avatar -->
      <div
        id="user-avatar"
        :class="[
          'w-10 h-10 brut-border flex items-center justify-center font-black text-ink text-sm cursor-default',
          isAdmin ? 'bg-neoPink' : 'bg-neoMint'
        ]"
      >
        {{ currentUser.initials }}
      </div>

      <!-- Logout — hidden on very small screens to avoid overflow -->
      <button
        id="logout-button"
        @click="logout"
        class="hidden sm:flex h-10 px-4 brut-border bg-neoCard items-center gap-2 font-black text-xs uppercase tracking-wide text-ink brut-hover cursor-pointer"
      >
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
          <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" /><polyline points="16,17 21,12 16,7" /><line x1="21" y1="12" x2="9" y2="12" />
        </svg>
        LOGOUT
      </button>
    </div>
  </header>
</template>
