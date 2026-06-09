<script setup>
import { useRoute } from 'vue-router'
import { useAuth } from '../../composables/useAuth'

const props = defineProps({
  isOpen: { type: Boolean, default: false }
})
const emit = defineEmits(['close'])

const route = useRoute()
const { isAdmin } = useAuth()

const navItems = [
  { path: '/dashboard', label: 'DASHBOARD',    icon: 'grid'    },
  { path: '/kanban',    label: 'KANBAN BOARD', icon: 'columns' }
]

const isActive = (path) => route.path === path

const closeSidebar = () => emit('close')
</script>

<template>
  <!-- ═══════════════════════════════════════════════════════════ -->
  <!-- DESKTOP: fixed sidebar (md+)                               -->
  <!-- ═══════════════════════════════════════════════════════════ -->
  <aside class="w-56 h-screen bg-neoSidebar brut-border border-t-0 border-l-0 border-b-0 flex flex-col hidden md:flex fixed z-20">
    <!-- Logo -->
    <div class="h-16 flex items-center gap-3 px-4 brut-border border-l-0 border-t-0 border-r-0">
      <div class="w-9 h-9 bg-neoIndigo brut-border flex items-center justify-center text-white font-black text-sm flex-shrink-0">
        W
      </div>
      <div class="leading-tight">
        <div class="text-sm font-black tracking-tight text-ink">Workforce</div>
        <div class="text-[0.6rem] font-bold uppercase tracking-widest text-neoMuted">HUB V2.0</div>
      </div>
    </div>

    <!-- Menu Label -->
    <div class="px-4 pt-5 pb-2">
      <span class="text-[0.6rem] font-black uppercase tracking-[0.15em] text-neoMuted">Menu</span>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-3 space-y-1.5">
      <router-link
        v-for="item in navItems"
        :key="item.path"
        :to="item.path"
        :class="[
          'flex items-center gap-3 px-3 py-2.5 brut-border text-xs font-black uppercase tracking-wide transition-all',
          isActive(item.path)
            ? 'bg-ink text-white shadow-[3px_3px_0_0_var(--shadow-color)]'
            : 'bg-neoCard text-ink brut-hover hover:bg-neoYellow'
        ]"
      >
        <svg v-if="item.icon === 'grid'" class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
          <rect x="3" y="3" width="7" height="7" /><rect x="14" y="3" width="7" height="7" /><rect x="3" y="14" width="7" height="7" /><rect x="14" y="14" width="7" height="7" />
        </svg>
        <svg v-if="item.icon === 'columns'" class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
          <rect x="3" y="3" width="7" height="18" /><rect x="14" y="3" width="7" height="18" />
        </svg>
        {{ item.label }}
      </router-link>

      <!-- Admin-only: Manage Workspace -->
      <router-link
        v-if="isAdmin"
        to="/workspace"
        :class="[
          'flex items-center gap-3 px-3 py-2.5 brut-border text-xs font-black uppercase tracking-wide transition-all',
          isActive('/workspace')
            ? 'bg-ink text-white shadow-[3px_3px_0_0_var(--shadow-color)]'
            : 'bg-neoCard text-ink brut-hover hover:bg-neoYellow'
        ]"
      >
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
          <rect x="4" y="2" width="16" height="20" /><line x1="9" y1="22" x2="9" y2="2" /><line x1="15" y1="22" x2="15" y2="2" /><line x1="4" y1="8" x2="20" y2="8" /><line x1="4" y1="14" x2="20" y2="14" />
        </svg>
        MANAGE WORKSPACE
      </router-link>

    </nav>

    <!-- TIP Box -->
    <div class="neo-tip-box">
      <span class="tip-label">TIP</span>
      <p>Press <span class="key-badge">N</span> to create a task. Press <span class="key-badge">⌘</span><span class="key-badge">K</span> for the command palette.</p>
    </div>
  </aside>

  <!-- ═══════════════════════════════════════════════════════════ -->
  <!-- MOBILE: slide-in drawer                                     -->
  <!-- ═══════════════════════════════════════════════════════════ -->
  <div class="md:hidden">
    <!-- Backdrop -->
    <transition name="fade">
      <div
        v-if="isOpen"
        class="fixed inset-0 z-[90] bg-black/50"
        @click="closeSidebar"
      />
    </transition>

    <!-- Drawer -->
    <transition name="drawer">
      <aside
        v-if="isOpen"
        class="fixed top-0 left-0 z-[95] h-full w-72 bg-neoSidebar brut-border border-t-0 border-l-0 border-b-0 flex flex-col shadow-[6px_0_0_0_var(--shadow-color)]"
      >
        <!-- Drawer Header -->
        <div class="h-16 flex items-center justify-between gap-3 px-4 brut-border border-l-0 border-t-0 border-r-0">
          <div class="flex items-center gap-3">
            <div class="w-9 h-9 bg-neoIndigo brut-border flex items-center justify-center text-white font-black text-sm flex-shrink-0">
              W
            </div>
            <div class="leading-tight">
              <div class="text-sm font-black tracking-tight text-ink">Workforce</div>
              <div class="text-[0.6rem] font-bold uppercase tracking-widest text-neoMuted">HUB V2.0</div>
            </div>
          </div>
          <!-- Close button -->
          <button
            @click="closeSidebar"
            class="w-8 h-8 brut-border bg-neoCard flex items-center justify-center font-black text-ink text-sm brut-hover cursor-pointer flex-shrink-0"
            aria-label="Close menu"
          >x</button>
        </div>

        <!-- Menu Label -->
        <div class="px-4 pt-5 pb-2">
          <span class="text-[0.6rem] font-black uppercase tracking-[0.15em] text-neoMuted">Menu</span>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-3 space-y-1.5">
          <router-link
            v-for="item in navItems"
            :key="item.path"
            :to="item.path"
            @click="closeSidebar"
            :class="[
              'flex items-center gap-3 px-3 py-2.5 brut-border text-xs font-black uppercase tracking-wide transition-all',
              isActive(item.path)
                ? 'bg-ink text-white shadow-[3px_3px_0_0_var(--shadow-color)]'
                : 'bg-neoCard text-ink brut-hover hover:bg-neoYellow'
            ]"
          >
            <svg v-if="item.icon === 'grid'" class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
              <rect x="3" y="3" width="7" height="7" /><rect x="14" y="3" width="7" height="7" /><rect x="3" y="14" width="7" height="7" /><rect x="14" y="14" width="7" height="7" />
            </svg>
            <svg v-if="item.icon === 'columns'" class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
              <rect x="3" y="3" width="7" height="18" /><rect x="14" y="3" width="7" height="18" />
            </svg>
            {{ item.label }}
          </router-link>

          <!-- Admin-only: Manage Workspace -->
          <router-link
            v-if="isAdmin"
            to="/workspace"
            @click="closeSidebar"
            :class="[
              'flex items-center gap-3 px-3 py-2.5 brut-border text-xs font-black uppercase tracking-wide transition-all',
              isActive('/workspace')
                ? 'bg-ink text-white shadow-[3px_3px_0_0_var(--shadow-color)]'
                : 'bg-neoCard text-ink brut-hover hover:bg-neoYellow'
            ]"
          >
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
              <rect x="4" y="2" width="16" height="20" /><line x1="9" y1="22" x2="9" y2="2" /><line x1="15" y1="22" x2="15" y2="2" /><line x1="4" y1="8" x2="20" y2="8" /><line x1="4" y1="14" x2="20" y2="14" />
            </svg>
            MANAGE WORKSPACE
          </router-link>

        </nav>

        <!-- TIP Box -->
        <div class="neo-tip-box">
          <span class="tip-label">TIP</span>
          <p>Press <span class="key-badge">N</span> to create a task. Press <span class="key-badge">⌘</span><span class="key-badge">K</span> for the command palette.</p>
        </div>
      </aside>
    </transition>
  </div>
</template>
