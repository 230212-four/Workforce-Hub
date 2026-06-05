import { ref, computed } from 'vue'

const notifications = ref([
  {
    id: 1,
    title: 'Task overdue',
    message: '"Fix bug in payment processing" is past its due date.',
    time: '2 hours ago',
    read: false,
    type: 'warning'
  },
  {
    id: 2,
    title: 'Task completed',
    message: '"Set up CI/CD pipeline" was marked as done.',
    time: '5 hours ago',
    read: false,
    type: 'success'
  },
  {
    id: 3,
    title: 'New assignment',
    message: 'You have been assigned to "Optimize database queries".',
    time: '1 day ago',
    read: false,
    type: 'info'
  },
  {
    id: 4,
    title: 'Status change',
    message: '"Update user authentication system" moved to In Progress.',
    time: '2 days ago',
    read: true,
    type: 'info'
  }
])

export function useNotifications() {
  const unreadCount = computed(() => notifications.value.filter(n => !n.read).length)
  const hasUnread = computed(() => unreadCount.value > 0)

  function markRead(id) {
    const notif = notifications.value.find(n => n.id === id)
    if (notif) {
      notif.read = true
    }
  }

  function markAllRead() {
    notifications.value.forEach(n => { n.read = true })
  }

  function addNotification(notification) {
    notifications.value.unshift({
      id: Date.now(),
      ...notification,
      read: false,
      time: 'Just now'
    })
  }

  return {
    notifications,
    unreadCount,
    hasUnread,
    markRead,
    markAllRead,
    addNotification
  }
}
