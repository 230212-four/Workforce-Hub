import axios from 'axios'
import { computed, ref } from 'vue'
import { useAuth } from './useAuth'

const notifications = ref([])
const notificationsLoaded = ref(false)
const isLoadingNotifications = ref(false)

function formatRelativeTime(value) {
  if (!value) return 'Just now'

  const diffMs = Date.now() - new Date(value).getTime()
  const diffMinutes = Math.max(0, Math.floor(diffMs / 60000))

  if (diffMinutes < 1) return 'Just now'
  if (diffMinutes < 60) return `${diffMinutes}m ago`

  const diffHours = Math.floor(diffMinutes / 60)
  if (diffHours < 24) return `${diffHours}h ago`

  const diffDays = Math.floor(diffHours / 24)
  return `${diffDays}d ago`
}

function normalizeNotification(notification) {
  return {
    id: notification.id,
    title: notification.title,
    message: notification.message,
    type: notification.type || 'info',
    read: Boolean(notification.read_at),
    readAt: notification.read_at || null,
    time: formatRelativeTime(notification.created_at),
    data: notification.data || {},
    taskId: notification.data?.task_id || null,
    userId: notification.user_id,
    createdAt: notification.created_at || null
  }
}

export function useNotifications() {
  const { currentUser, isAuthenticated } = useAuth()

  const unreadCount = computed(() => notifications.value.filter(notification => !notification.read).length)
  const hasUnread = computed(() => unreadCount.value > 0)

  async function loadNotifications() {
    if (!isAuthenticated.value || !currentUser.value.id) {
      notifications.value = []
      notificationsLoaded.value = true
      return notifications.value
    }

    if (isLoadingNotifications.value) {
      return notifications.value
    }

    isLoadingNotifications.value = true
    try {
      const { data } = await axios.get('/api/notifications')
      notifications.value = (data.data || []).map(normalizeNotification)
      notificationsLoaded.value = true
      return notifications.value
    } finally {
      isLoadingNotifications.value = false
    }
  }

  async function markRead(id) {
    const notification = notifications.value.find(item => item.id === id)
    if (!notification || notification.read) {
      return notification || null
    }

    const { data } = await axios.put(`/api/notifications/${id}`, {
      read_at: new Date().toISOString()
    })

    const updated = normalizeNotification(data.data)
    notifications.value = notifications.value.map(item => (item.id === updated.id ? updated : item))
    return updated
  }

  async function markAllRead() {
    await axios.post('/api/notifications/mark-all-read')
    notifications.value = notifications.value.map(notification => ({
      ...notification,
      read: true,
      readAt: new Date().toISOString()
    }))
  }

  return {
    notifications,
    unreadCount,
    hasUnread,
    notificationsLoaded,
    isLoadingNotifications,
    loadNotifications,
    markRead,
    markAllRead
  }
}
