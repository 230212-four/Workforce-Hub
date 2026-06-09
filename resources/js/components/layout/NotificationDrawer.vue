<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { useNotifications } from '../../composables/useNotifications'
import { useTaskStore } from '../../composables/useTaskStore'

const props = defineProps({
  isOpen: { type: Boolean, default: false }
})

const emit = defineEmits(['close', 'open-task'])

const { notifications, unreadCount, markRead, markAllRead } = useNotifications()
const { tasks } = useTaskStore()

const typeIcons = {
  warning: '⚠️',
  success: '✅',
  info: 'ℹ️'
}

const handleMarkAllRead = () => {
  markAllRead()
}

const handleNotifClick = (notif) => {
  markRead(notif.id)

  // If this notification has a linked taskId, find the task and open it
  if (notif.taskId) {
    const linkedTask = tasks.value.find(t => t.id === notif.taskId)
    if (linkedTask) {
      emit('open-task', linkedTask)
    }
  }
}

// Close on Escape key
const handleKeydown = (e) => {
  if (e.key === 'Escape' && props.isOpen) {
    emit('close')
  }
}

onMounted(() => {
  document.addEventListener('keydown', handleKeydown)
})

onUnmounted(() => {
  document.removeEventListener('keydown', handleKeydown)
})
</script>

<template>
  <Teleport to="body">
    <!-- Backdrop -->
    <transition name="fade">
      <div
        v-if="isOpen"
        class="fixed inset-0 z-[9999] w-screen h-screen bg-zinc-900/80 backdrop-blur-sm"
        @click="$emit('close')"
      />
    </transition>

    <!-- Drawer Panel -->
    <transition name="notif-drawer">
      <div
        v-if="isOpen"
        class="fixed top-0 right-0 h-screen z-[10000] w-full max-w-sm bg-neoCard flex flex-col"
        style="border-left: 3px solid var(--border-color); box-shadow: -6px 0 0 0 var(--shadow-color);"
      >
        <!-- Header -->
        <div
          class="flex items-center justify-between p-5"
          style="border-bottom: 2px solid var(--border-color);"
        >
          <div class="flex items-center gap-3">
            <svg class="w-5 h-5 text-ink flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
              <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" /><path d="M13.73 21a2 2 0 0 1-3.46 0" />
            </svg>
            <div>
              <h2 class="text-sm font-black uppercase tracking-wide text-ink leading-tight">
                Notifications
              </h2>
              <p v-if="unreadCount > 0" class="text-[0.6rem] font-bold text-neoMuted uppercase tracking-wide">
                {{ unreadCount }} unread
              </p>
            </div>
          </div>
          <div class="flex items-center gap-2">
            <button
              v-if="unreadCount > 0"
              @click="handleMarkAllRead"
              class="text-[0.6rem] font-black text-neoIndigo hover:underline uppercase tracking-wide cursor-pointer px-2 py-1"
            >
              Mark all read
            </button>
            <button
              @click="$emit('close')"
              class="w-8 h-8 brut-border bg-neoCard flex items-center justify-center font-black text-ink text-sm brut-hover cursor-pointer"
            >✕</button>
          </div>
        </div>

        <!-- Notification List -->
        <div class="flex-1 overflow-y-auto">
          <div
            v-for="notif in notifications"
            :key="notif.id"
            @click="handleNotifClick(notif)"
            :class="[
              'px-5 py-4 cursor-pointer transition-colors',
              notif.read
                ? 'opacity-50 hover:opacity-75'
                : 'hover:bg-neoYellow/10'
            ]"
            style="border-bottom: 1px solid var(--border-color);"
          >
            <div class="flex items-start gap-3">
              <span class="text-base mt-0.5 flex-shrink-0">{{ typeIcons[notif.type] || 'ℹ️' }}</span>
              <div class="flex-1 min-w-0">
                <div class="flex items-center gap-2">
                  <p class="text-xs font-black text-ink leading-tight">{{ notif.title }}</p>
                  <span v-if="!notif.read" class="w-2 h-2 bg-destructive rounded-full flex-shrink-0"></span>
                </div>
                <p class="text-[0.7rem] text-neoMuted mt-0.5 leading-snug">{{ notif.message }}</p>
                <div class="flex items-center gap-2 mt-1.5">
                  <p class="text-[0.6rem] font-bold text-neoMuted uppercase">{{ notif.time }}</p>
                  <span
                    v-if="notif.taskId"
                    class="text-[0.55rem] font-black uppercase tracking-wide text-neoIndigo bg-neoIndigo/10 px-1.5 py-0.5 border border-neoIndigo/30"
                  >
                    → Open Task
                  </span>
                </div>
              </div>
            </div>
          </div>

          <!-- Empty state -->
          <div v-if="notifications.length === 0" class="px-5 py-12 text-center">
            <div class="text-3xl mb-3">🔔</div>
            <p class="text-xs font-black text-neoMuted uppercase">No notifications</p>
          </div>
        </div>
      </div>
    </transition>
  </Teleport>
</template>
