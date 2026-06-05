<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { useNotifications } from '../../composables/useNotifications'

const props = defineProps({
  isOpen: { type: Boolean, default: false }
})

const emit = defineEmits(['close'])

const { notifications, unreadCount, markRead, markAllRead } = useNotifications()

const dropdownRef = ref(null)

const typeIcons = {
  warning: '⚠️',
  success: '✅',
  info: 'ℹ️'
}

const handleClickOutside = (e) => {
  if (dropdownRef.value && !dropdownRef.value.contains(e.target)) {
    // Check if click was on the bell button
    const bell = document.getElementById('notification-bell')
    if (bell && bell.contains(e.target)) return
    emit('close')
  }
}

const handleMarkAllRead = () => {
  markAllRead()
}

const handleNotifClick = (notif) => {
  markRead(notif.id)
}

onMounted(() => {
  document.addEventListener('click', handleClickOutside)
})

onUnmounted(() => {
  document.removeEventListener('click', handleClickOutside)
})
</script>

<template>
  <transition name="dropdown">
    <div
      v-if="isOpen"
      ref="dropdownRef"
      class="absolute top-full right-0 mt-2 w-80 bg-neoCard brut-border brut-shadow z-50"
    >
      <!-- Header -->
      <div class="flex items-center justify-between px-4 py-3 brut-border border-l-0 border-r-0 border-t-0">
        <h3 class="text-xs font-black uppercase tracking-wider text-ink">
          Notifications
          <span v-if="unreadCount > 0" class="ml-2 bg-destructive text-white px-2 py-0.5 text-[0.6rem] brut-border">
            {{ unreadCount }}
          </span>
        </h3>
        <button
          v-if="unreadCount > 0"
          @click="handleMarkAllRead"
          class="text-[0.65rem] font-bold text-neoIndigo hover:underline uppercase tracking-wide cursor-pointer"
        >
          Mark all read
        </button>
      </div>

      <!-- Notification List -->
      <div class="max-h-72 overflow-y-auto">
        <div
          v-for="notif in notifications"
          :key="notif.id"
          @click="handleNotifClick(notif)"
          :class="[
            'px-4 py-3 cursor-pointer transition-colors brut-border border-l-0 border-r-0 border-t-0 last:border-b-0',
            notif.read ? 'opacity-60' : 'bg-neoYellow/10'
          ]"
        >
          <div class="flex items-start gap-3">
            <span class="text-base mt-0.5 flex-shrink-0">{{ typeIcons[notif.type] || 'ℹ️' }}</span>
            <div class="flex-1 min-w-0">
              <p class="text-xs font-black text-ink leading-tight">{{ notif.title }}</p>
              <p class="text-[0.7rem] text-neoMuted mt-0.5 leading-snug">{{ notif.message }}</p>
              <p class="text-[0.6rem] font-bold text-neoMuted mt-1 uppercase">{{ notif.time }}</p>
            </div>
            <span v-if="!notif.read" class="w-2 h-2 bg-destructive rounded-full flex-shrink-0 mt-1.5"></span>
          </div>
        </div>
      </div>

      <!-- Empty state -->
      <div v-if="notifications.length === 0" class="px-4 py-8 text-center">
        <p class="text-xs font-bold text-neoMuted uppercase">No notifications</p>
      </div>
    </div>
  </transition>
</template>
